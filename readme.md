<h1>Bare minimum MVC framework 3000</h1>

N.B. This framework is not production ready and might contain bugs. Minor improvements and fixes are welcome.

Requirements:
php >= 7.0, mysql >=5.6
        
Installation:
1. Configure Nginx. Entry point is /public/index.php
2. In /config/app.php set correct credentials for database
3. Sample page requires existing table 'users'. SQL command is in he sample.sql file

Structure:
    classes - framework base classes
    config - config files
    controllers
    models - data models
    repositories - data access
    views - ui renders
    public - public files like js/css/images
