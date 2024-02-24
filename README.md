Instructions for starting:
<ol>
  <li>
    Clone the project from the link: https://github.com/DroidStudioAS/za_paragraf.git
  </li>
  <li>
    Extract the dump from the project and import the database locally into phpmyadmin, mysqlworkbench, or any other database administration tool of your choice (I used phpmyadmin).
     <ul>
    <li>
      I used the root user for the username, so there is no need for special settings.
    </li>
    <li>
      The dump contains a create database statement, so you don't need to create a schema for import.
    </li>
    </ul>
  </li> 
  <li>
    Running the project:
    <ul>
    <li>
      If you are using VSCode and have the PHP server extension installed, you can run the task using the serve project function (ctrl+shift+p->Serve Project). 
    </li>
    <li>
     If you are running the project on your local server (wamp, xampp, lamp..), simply move the cloned project to the root directory of your server (www, htdocs, /var/www/html/).
These are the steps I am familiar with, you may know of others, and it should work for whichever you choose.
    </li>
    </ul>
  </li>
</ol>



 
