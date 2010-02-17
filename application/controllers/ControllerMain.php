<?php
class ControllerMain extends ControllerBase {
 
 public function actionPre() {
   $this->getTemplate()->header->mainNavSelected = $this->getRouter()->getControllerName();
   $this->getTemplate()->header->mainNav = array(
     'main' => 'Main',
     'calendar' => 'Calendar',
     'listings' => 'Listings',
     'blog' => 'Blog',
     'about' => 'About',
     'contact' => 'Contact'
   );
  
    $this->_checkForTwitterUpdates();  
 }
 
  protected function _checkForTwitterUpdates() {

    $username = 'creativeartsg';
    $password = 'grammarPolice101';
    $max_results = 5;
    $cache_filepath = DIR_CACHE . 'twitter-'.$username.'.cache';

    $file_modified_time = filemtime($cache_filepath);
    $now = time();
    $cache_time = 1; // ten minutes
    
    if(($now - $file_modified_time) > $cache_time) {

      $Twitter = new Twitter($username, $password);   
      $twitter_xml = $Twitter->getUserTimeline();

      $fhandle = fopen($cache_filepath, 'wb');
      fwrite($fhandle, $twitter_xml);
      fclose($fhandle);

    } else {
      
      $twitter_xml = file_get_contents($cache_filepath);
      
    }
    
    $twitter_posts = array();
    
    $twitter_status = new SimpleXMLElement($twitter_xml);
    foreach($twitter_status->status as $status){
      
      $text = $status->text;
	      
      $timestamp = strtotime((String)$status->created_at);
      $created_at = 'Posted '.date('D M j Y \a\t g\:ia', $timestamp);
      $text = (string)$status->text;
      $ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $text);
      $ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);
      $ret = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $ret);
      $ret = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $ret);
      $text_wlinks = $ret;
      $twitter_posts[] = array(
        'text' => $text_wlinks,
        'created' => $created_at,
      );
      
      if(sizeof($twitter_posts) > $max_results) {
        $twitter_user = $status->user;
        $twitter_user_info = array(
          'followers_count' => (int)$status->user->followers_count,
          'description' => (string)$status->user->description,
          'screen_name' => (string)$status->user->screen_name,
          'profile_img_url' => (string)$status->user->profile_background_image_url
        );
        break;
      } 
    }

    //print_r($twitter_status);followers_count description screen_name profile_background_image_url
    $this->getTemplate()->body->twitter_posts = $twitter_posts;
    $this->getTemplate()->body->twitter_user_info = $twitter_user_info;
    //print_r($twitter_user_info);
    
    //$this->getCache();

  }
 
  public function actionDefault() {
  }
  
}
/*
<div class="feedPost feedNews">
  <h2>This is a main news feed, describing the subject matter.</h2>
  <p>
    Those singers lent her a lot of money. They tell them a joke. Bruce 
    granted him his wish. That car mechanic promises her a new house. 
    That farmer buys him a present. They tell them a joke.
  </p>
  <p>
    Those dentists asked him a question. They struck him a heavy blow. 
    Luke gives him a magazine. I envied him his good fortune. I wrote her 
    a letter. Those dentists asked him a question. They struck him a heavy 
    blow. Luke gives him a magazine. I envied him his good fortune.
  </p>
  <ul class="feedRate">
    <li><p>Rate</p></li>
    <li class="feedRateDown"><a href="/"><span>Dislike</span></a></li>
    <li class="feedRateUp"><a href="/"><span>Like</span></a></li>
  </ul>
  <ul class="feedInfo">
    <li><p>Posted 8 hours ago</p></li>
    <li>a href="/">20 Comments</a></li>
    <li class="feedPostType"><p>Via Main News Channel</p></li>
  </ul>
</div>
*/
