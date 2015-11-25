#Template Structure
Default file structure is:
###header.php
function to get header file to any where of template is: get_header(); Even can use additional or other header file. but header name
should header-[other_name].php . Suppose your another header file wilt for contact page. file name will: header-contact.php and 
to get this contact header file. function: get_header('contact');

###footer.php
function to get footer file to any where of template is: get_footer(); Even can use additional or other footer file. but footer name
should footer-[other_name].php . Suppose your another footer file wilt for contact page. file name will: footer-contact.php and 
to get this contact header file. function: get_footer('contact');

###post.php
Post file for all post/blog's single page template. By default all single blog post will show by post.php file

###page.php 
Post file for all page's single page template. By default all single content page will show by page.php file

###Comment.php
You can make comment.php file to use any default style/layout for comment secton. Otherwise for comment, there are two function available. one is for showing comment: comment() and another is: comment_form(); 
<ul>
  <li>comment();
  <li>comment_form();
  
By the way, there is too many customization for comment() and comment_form() functions. will explain at function_documentaion page




