<?php
class ControllerMain extends ControllerSession {

  /**
   * function is run before action function
   * @override
   */
  public function actionPre() {
    
    /* call parent actionPre function */
    parent::actionPre();

    /* check for new twitter updates */
    $this->_checkForTwitterUpdates();  

  }


  protected function _addTwitterLinks($s) {

    /* uses regular expressions to add links to text field from twitter feed 
       for @names, #keywords, etc */
    $ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $s);
    $ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);
    $ret = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $ret);
    $ret = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $ret);
    return $ret;
    
  }
 
  protected function _checkForTwitterUpdates() {

    $cache_time = 300;
    $cache_filepath = DIR_CACHE . 'twitter-'.APIA_TWITTER_USER.'-pull-ts.cache';
    
    $last_pull_time = (int)@file_get_contents($cache_filepath);
    $now_time = time();

    if(($now_time - $last_pull_time) > $cache_time) {

      /* get the last entered twitter entry */
      $query = 'SELECT UNIX_TIMESTAMP(creativeartsguide.feed.timestamp) AS time 
                FROM creativeartsguide.feed 
                WHERE creativeartsguide.feed.type=3 
                ORDER BY creativeartsguide.feed.timestamp DESC 
                LIMIT 1';
      $DbStmt = $this->getDatabase()->prepare($query)->execute();
      $DbStmt->first();
      $last_item_pulled = ($DbStmt->time ? $DbStmt->time : 0000000000);
      $last_item_pulled = (int)$last_item_pulled + 1;

      /* use Twitter API class to get XML return for request */
      $Twitter = new Twitter(APIA_TWITTER_USER, APIA_TWITTER_PASS);   
      $twitter_xml = $Twitter->getUserTimeline();      
      $twitter_status = new SimpleXMLElement($twitter_xml);

      $i=0;
      
      /* loop through each returned tweet (or status) */
      foreach($twitter_status->status as $s) {

        /* get the information we need from the object */
        $t_time = (int)strtotime($s->created_at);
        $t_fav = (string)$s->favorited;
        $t_text = (string)$this->_addTwitterLinks($s->text);
        
        /* skip any posts that are already in the database */
        if($last_item_pulled > $t_time) { continue; }

        /* skip any posts that are not favorited */
        if((string)$s->favorited != 'true') { continue; }


        /* insert new twitter post id and timestamp */
        $query = 'INSERT INTO :T1 
                  SET :T1.type=:A1, 
                      :T1.timestamp=FROM_UNIXTIME(:A2)';
        $DbStmt = $this->getDatabase()->prepare($query, array('creativeartsguide.feed'))->execute(array(3, $t_time));
        $insert_id = $DbStmt->insertId();
        
        /* insert new twitter post content */
        $query = 'INSERT INTO :T1 
                  SET :T1.feed_id=:A1, :T1.post=:A2';
        $DbStmt = $this->getDatabase()->prepare($query, array('creativeartsguide.feed_post'))->execute(array($insert_id, $t_text));
        
      }

      /* cache this data... */
      $fhandle = fopen($cache_filepath, 'wb');
      fwrite($fhandle, time());
      fclose($fhandle);
      
    }

  }

  protected function _getLatestTwitter($resultCount = 6) {
    
    /* get the last entered twitter entry */
    $query = 'SELECT UNIX_TIMESTAMP(creativeartsguide.feed.timestamp) AS time 
              FROM creativeartsguide.feed 
              WHERE creativeartsguide.feed.type=3 
              ORDER BY creativeartsguide.feed.timestamp DESC 
              LIMIT '.$resultCount;
    $DbStmt = $this->getDatabase()->prepare($query)->execute();
    
    while($DbStmt->next() !== false)
    {
      $DbStmt->time;
    }
    
  }
 
  public function actionDefault() {
 
    $posts = array(
      (int)strtotime('February 17 2010 1:36am') => array(
        'title' => 'An interesting title for a much less interesting, and much less interesting it is, story',
        'created' => 'February 17 2010 1:36am',
        'channel' => 'Official News',
        'comments' => 4,
        'rating' => 9,
        'text' => 'Those singers lent her a lot of money. They tell them a joke. Bruce granted him his wish. That car mechanic promises her a new house. That farmer buys him a present. They tell them a joke.
                   Those dentists asked him a question. They struck him a heavy blow. Luke gives him a magazine. I envied him his good fortune.
                   Those singers lent her a lot of money. They tell them a joke. Bruce granted him his wish. That car mechanic promises her a new house. That farmer buys him a present. They tell them a joke.
                   They struck him a heavy blow. Luke gives him a magazine. They struck him a heavy blow. Luke gives him a magazine. They struck him a heavy blow. Luke gives him a magazine. They struck him a heavy blow. Luke gives him a magazine. They struck him a heavy blow. Luke gives him a magazine. I envied him his good fortune.
                   They struck him a heavy blow. Luke gives him a magazine. I envied him his good fortune. I wrote her a letter. Those dentists asked him a question. They struck him a heavy blow. Luke gives him a magazine. I envied him his good fortune.'
      ),
      (int)strtotime('January 16 2010 1:12am') => array(
        'title' => 'This is a main news feed, describing the subject matter',
        'created' => 'January 16 2010 1:12am',
        'channel' => 'Official News',
        'comments' => 21,
        'rating' => 7,
        'text' => 'Those singers lent her a lot of money. They tell them a joke. Bruce granted him his wish. That car mechanic promises her a new house. That farmer buys him a present. They tell them a joke.
                   Those dentists asked him a question. They struck him a heavy blow. Luke gives him a magazine. I envied him his good fortune.
                   They struck him a heavy blow. Luke gives him a magazine. I envied him his good fortune. I wrote her a letter. Those dentists asked him a question. They struck him a heavy blow. Luke gives him a magazine. I envied him his good fortune.'
      ),
      (int)strtotime('February 15 2010 6:37pm') => array(
        'title' => 'Well here is another stupid heading to show the dynamic nature of this page layout, as this header is very long',
        'created' => 'February 15 2010 6:37pm',
        'channel' => 'Official News',
        'comments' => 6,
        'rating' => -11,
        'text' => 'Those singers lent her a lot of money. They tell them a joke. Bruce granted him his wish. That car mechanic promises her a new house. That farmer buys him a present. They tell them a joke.
                   Those dentists asked him a question. They struck him a heavy blow. Luke gives him a magazine. I envied him his good fortune. I wrote her a letter. Those dentists asked him a question. They struck him a heavy blow. Luke gives him a magazine. I envied him his good fortune.'
      ),
      (int)strtotime('February 12 2010 5:49pm') => array(
        'title' => 'Well here is another stupid heading to show the dynamic nature of this page layout, as this header is very long',
        'created' => 'February 12 2010 5:49pm',
        'channel' => 'Official News',
        'comments' => 37,
        'rating' => 38,
        'text' => 'Those singers lent her a lot of money. They tell them a joke. Bruce granted him his wish. That car mechanic promises her a new house. That farmer buys him a present. They tell them a joke.
                   Those dentists asked him a question. They struck him a heavy blow. Luke gives him a magazine. I envied him his good fortune. I wrote her a letter. Those dentists asked him a question. They struck him a heavy blow. Luke gives him a magazine. I envied him his good fortune.'
        )      
    );
   
   $twitter_posts = $this->_getLatestTwitter();
   
    $all_posts = array_merge_keys(array(), $posts);
    //print_r($all_posts);
    krsort($all_posts, SORT_NUMERIC);
    
    //print_r($all_posts);
    $this->getTemplate()->body->all_posts = $all_posts;
  }
  
}
?>