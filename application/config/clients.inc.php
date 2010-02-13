<?php
$clients = array(
  
  'hamcommvideo' => array(
      'fullname' => 'Kevin Aspinwall (Hamilton Communications)',
      'invoices' => array(
      
        130001 => array(
        
          'date' => 'January 21 2010',
          'desc' => 'For this project, the design work would be completed. This project only includes the programming (both backend and visual). <br><br>
          I would need to take the current web content from Freeway and create pages outside of the software (how I would normally do it). These files will be 
          based on simple XHTML 1.1 and CSS 2.1 and 3. Additionally, the image galleries will be implemented using JavaScript. <br><br>
          Tags for proper search optimization will be created, as well as all other methods at our disposal to help with your site rank in all major browsers.',
          'paid' => false,
          'items' => array(
            array(
              'Additional website programming',
              48,
              12
            ),
            array(
              'Yearly Hosting Package - Unlimited Plan',
              200,
              1
            ),
            array(
              'One Time Hosting Setup Fee',
              69,
              1
            ),
            array(
              'Moin Dynamic Backend Implementation',
              300,
              1
            )
          )
          
        )
        
      )
  ),
  
  'lisa-mikulski' => array(
    'fullname' => 'Lisa Mikulski (DragonFly Blu Design)',
    'invoices' => array(

      120004 => array(
        
        'date' => 'January 15 2009',
        'desc' => 'A database (Mysql) enabled application that allows for the insertion of entries into a "galleries" listing, along with e-mail moderation.',
        'paid' => false,
        'items' => array(
          array(
            'Info entry application',
            34,
            10.5
          )
        )
        
      ),
    
      120003 => array(
        
        'date' => 'November 13 2009',
        'desc' => 'The implementation of a simple (non-api) Google Checkout system for www.zangstudios.com. The usage would allow for the client to sell a set of work through a Google Checkout link below each item. The number of items would need to be set to a known number, although there is no limit to the number that can be sold.<br /><br />
        This implementation does not include any dynamic page functionality. Simply, the page selling work will be a static HTML page without JavaScript or extensive PHP functionality. The page will be created to mimic the current site design.',
        'paid' => false,
        'items' => array(
          array(
            'Creation of simple checkout functionality',
            34,
            6
          )
        )
      ),

      120002 => array(
        
        'date' => 'November 5 2009',
        'desc' => 'A simplistic, modular image gallery system will be created to allow for its use on any website without the need for external dependencies. The gallery will be contained within a folder and will simply need to be "dropped in" to any existing websites without any hassle. The gallery will be written using PHP5, structured with XHTML 1.1, and styled with CSS 2.1 and CSS 3. Effects will be achieved with JavaScript. To facilitate JavaScript programming and to provide a underlying baseline, the open source MooTools framework will be used. Information on MooTools is available at <a href="http://mootools.net">mootools.net</a>. 
        <br /><br />
        The presentation of the gallery will be minimal. Galleries will be structured as list items (&lt;li&gt;), as will images inside a gallery. Thumbnails will be generated automatically from the full&ndash;size images and full&ndash;sized images will be displayed inside an overlay box when thumbnails are clicked using JavaScript in a similar fashion as <a href="http://www.huddletogether.com/projects/lightbox2/">Lightbox</a>. Each gallery will support slideshow presentations, with fade effects when moving from one picture to another.
        <br /><br />
        The back&ndash;end system will rely on a directory based structure to depict the gallery hierarchy. Creating a new gallery will be as simple as dropping a folder into they base folder with the images for that particular gallery within. The system will support both gallery and image titles and descriptions, written in a text file contained within the specific gallery folder. The easiest way to manage such a gallery system would be to simply prepare the gallery folder on ones personal computer and use a transfer protocol such as FTP or SCP to place the folder within the program base folder on the server afterward.
        <br /><br />
        This system will also allow for another text-based config file that will enable prices to be set for each image that will generate Google Checkout buttons below the expanded image. This will allow for artists to optionally sell their work.',
        'paid' => false,
        'items' => array(
          array(
            'Creation of modular image gallery',
            34,
            18
          )
        )
      ),
    
      120001 => array(
      
        'date' => 'November 5 2009',
        'desc' => '
          The entirety of the website scottkahnpainter.com, currently an  Adobe Flash based design, will be recreated using modern and accessible web standards, including XHTML 1.1, CSS 2.1 and CSS 3, and JavaScript. To facilitate JavaScript programming and to provide a underlying baseline, the open source MooTools framework will be used. Information on MooTools is available at <a href="http://mootools.net">mootools.net</a>. 
          <br /><br />
          The redesign will include all feature currently present on the website along with some additional functionality. The top level website navigation will remain the same and will include image gallery, reviews, resume, and contact pages. The image gallery will include the following feature: the ability for multiple galleries, or&mdash;as they are currently called on the website&mdash;groups; the ability to enlarge thumbnail images, allowing visitors to view full&ndash;size versions; the ability to add title and descriptive information to both galleries and individual images; lastly, the ability to view gallery slideshows. Gallery and image information will be stored using the MySQL open source database server, with a simple front&ndash;end to allow the client to administer the gallery. The contact page will use JavaScript to check form fields for validity and to post the form content without a page refresh&mdash;known commonly as AJAX requests. The reviews and resume pages will not include any JavaScript functionality.
          <br /><br />
          New functionality will include the ability to purchase prints online. This will be accomplished using the Google Checkout API, which will allow for transactions to be completed without leaving scottkahnpainter.com. Additional information on the Google Checkout API is available at <a href="http://code.google.com/apis/checkout/">Google Code</a>. Using such a service allows for visitors to present credit card information, which is then sent to the Google Checkout system using AJAX requests. This will allow for the client to confirm payment is valid before investing time and money in production of the product.
        ',
        'paid' => false,
        'items' => array(
          array(
            'Recreation of scottkahnpainter.com using JavaScript',
            34,
            10
          ),
          array(
            'Shopping cart and checkout system for scottkahnpainter.com',
            34,
            5
          )
        )
      )
    )
  ),

  'enterpc' => array(
    'fullname' => 'Enterprise Computer',
    'invoices' => array(

      100003 => array(
        'date' => 'August 25 2009',
        'desc' => 'A web design mockup was made for mdeanlaw.com that
          consisted of a "documents" page as well as a generic "under construction"
          page that all other anchor tags link to. The mockup uses the color
          scheme discussed: shades of green and brown. The mockup is available
          to view here:
          <a href="http://static.robfrawley.com/clients/enterpc-mdeanlaw.com/">
          http://static.robfrawley.com/clients/enterpc-mdeanlaw.com/</a>.',
        'paid' => false,
        'items' => array(
          array(
            'Mockup for mdeanlaw.com',
            35,
            6.5
          ),
          array(
            'Mockup now live with updated documents',
            25,
            .25
          )
        )
      ), /* END INVOICE 530002 */

	    100002 => array(
        'date' => 'August 25 2009',
        'desc' => 'A bunch of small items were completed on trailsendct.com.
          The HTML was re-written from scratch to remove the iframes and
          clean up the codebase. A simple page generation engine was
          implemented in PHP. Lastly, some additional content updates were
          applied to trailsendct.com. Note: I am not charging for the PHP
          backend as I did not discuss it with you prior to completing it.',
        'paid' => false,
        'items' => array(
          array(
            'HTML Re-Write for trailsendct.com',
            25,
            2.25
          ),
          array(
            'PHP Page Engine for trailsendct.com',
            0,
            2.75,
            0
          ),
          array(
            'Content Updates for trailsendct.com',
            25,
            1.5
          )
        )
      ), /* END INVOICE 530001 */

      100001 => array(
        'date' => 'August 21 2009',
        'desc' => 'Used UltraVNC to create a "GoToMyPC" equivalent using
          a VNC repeater inside the EnterPC internal network to avoid
          client connection firewall issues. Here are the steps taken to
          create a connection with a technician: 1) client download executable
          from enterpc.com; 2) client calls EnterPC (per the program directions;
          3) client is instructed to select Technician 1 through 10; 4) Technician
          then uses any VNC client to connect to the VNC repeater, using
          ID:<1-10> as the server, and enterserver.enterc.com:443 as the proxy;
          5) Technician is connected to remote machine.',
        'paid' => true,
        'items' => array(
          array(
            'Setup VNC server for support calls',
            20,
            5
          )
        )
      ), /* END INVOICE 530000 */

      100000 => array(
        'date' => 'August 20 2009',
        'desc' => 'Three updates to the trailsendct.com website. Firstly, the
          page content was centered. Secondly, borders were added around all
          product thumbs. Lastly, a small PHP script was written to generate the
          large product pictures, allowing for them all to be same-sized and
          styled the same (with a two framed border).',
        'paid' => true,
        'items' => array(
          array(
            'Centered trailsendct.com website content',
            20,
            2
          ),
          array(
            'Styled the product thumbnails with frames',
            20,
            0.75
          ),
          array(
            'Wrote large product picture PHP script',
            20,
            2.25
          )
        )
      )

    ) /* END CLIENT enterpc */

  )
);
?>