# Student Catalog System [Web]
![](https://img.shields.io/badge/Author-RepeaterCreeper-For--The--Badge?logo=github&style=for-the-badge)
![](https://img.shields.io/github/license/RepeaterCreeper/web-practice?style=for-the-badge) ![](https://img.shields.io/github/issues/RepeaterCreeper/web-practice?style=for-the-badge)

![](https://imgur.com/Qoezsvi.png)

The Student Catalog System is as the name implies catalogs all the student and puts all the information that is available in the database. This system is aimed to be scale as the number of user grows. However, at the moment it's currently in its infancy and there isn't much aside from very basic CRUD system. If you wish to contribute, the code base for this is going to be open-source. A roadmap is provided down below to give you a general idea of where this is headed.

**NOTE**: There is an alternate version that is currently under development built with Electron. Functionality is the same, but with a little bit of extra features. However, the Electron version will ONLY be following what the Web version has.

## Current Features
- CRUD for Student Informations
    - **C**reating via the *Add New Record* button
    - **R**eading via the *Search* button
    - **U**pdating via the *Edit Record* button
    - **D**eleting via the *Delete Record* button
- AJAX Implementation to allow for smoother interaction between website and the user.


## Roadmap
- **[PRIORITY]** Add form validation.
- Create a *config.php* file to be used a central point for setting all necessary fields to setup the System.

## Project Setup / Installation
1. `git clone https://github.com/RepeaterCreeper/web-practice.git` (If you wish to add a folder name or a specific directory you wish to clone in just add it at the end.)
2. `cd web-practice` change directory to the cloned repository directory. (Unless you changed the name, it should be web-practice.)
3. If using xampp, open up PHPMyAdmin and go to the **IMPORT** tab.
4. Press **CHOOSE FILE** and select the database file located in the project directory named `studentcatalog.sql`. 
5. Go to `localhost/projects/studentcatalog-basic` and you should see this running.