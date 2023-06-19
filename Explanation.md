# Explanation: URL Homepage Scanner - SiteScanX

## Problem Statement

The problem to be solved is to develop a tool that can scan the homepage of a provided URL and extract its internal
links. This tool will help users gather information about the internal links of the website to aid in SEO analysis.


## Proposed Solution 
To achieve the desired outcome for the admin, as stated in the user story, the URL Homepage Scanner should allow them to gain
insights
into the internal structure and organization of a website. It provides a simple and efficient way to extract and analyze
internal links from the homepage of a given URL, helping admins
understand the website's navigation and improve its overall structure.

## Technical Specification

To solve the problem, we will create a URL Homepage Scanner that performs the following steps:

1. Accepts a URL input from the user.
2. Initiates an HTTP request to retrieve the HTML content of the provided URL's homepage.
3. Parses the HTML content to identify internal links.
4. Stores the extracted internal links for further analysis or display.

## Technical Decisions

In order to develop the URL Homepage Scanner, the following technical decisions were made:

1. Language: I chose to implement the scanner in PHP due to its extensive web development capabilities and compatibility
   with popular web frameworks and libraries.
2. File Structure: I organized the project files into directories based on their functionality, such
   as `admin`, `assets`, `classes`, `config`, and `includes`, to ensure modularity and maintainability.
3. Class Design: I also created a dedicated `WebsiteScannerClass` that encapsulates the URL scanning functionality,
   making it easier to extend and test, other functionalities of the project were also designed this way.
4. Dependency Management: I used Composer to manage project dependencies, allowing for easy installation and version
   control of external libraries.

## Core Code Functionality

The code for the URL Homepage Scanner works as follows:

1. The user provides a URL to scan.
2. The `WebsiteScannerClass` initiates an HTTP request to the provided URL's homepage using a library like cURL or
   Guzzle.
3. The HTML content of the homepage is retrieved and passed to an HTML parser, such as DOMDocument or SimpleHTMLDom, to
   extract the internal links.
4. Internal links are identified based on the URL's domain and stored in an array or database for further analysis or
   display.
5. The extracted internal links can be presented to the user through a web interface or used for other purposes, such as
   generating a sitemap or performing SEO analysis.


## Thinking Process and Solution

When approaching the problem, I considered the need for a tool that could efficiently scan and extract internal links
from a website. I chose to focus on the homepage because it serves as a starting point for website navigation. By
analyzing the internal links on the homepage, admins can gain valuable insights into the website's structure and user
flow.


## Project Structure

The project follows a specific file structure to organize its components and ensure modularity. Here's a brief overview
of the main directories and files:
The project's modular structure allows for easy extensibility and customization.
Additional features, such as link validation or link depth scanning, can be implemented by extending the existing
functionality or adding new classes.

```bash

┌─ ~/Code/wp-media-work (feature/interface-mods) ✗ 
└──➜ tree -L 2                                                                                                                                                                                                                       samuelladapo@samuels-mbp
.
├── Explanation.md
├── HelloWorld.php
├── README.md
├── admin
│ ├── ajax
│ ├── crons
│ └── dashboard.php
├── assets
│ ├── landing-page
│ └── user-portal
├── classes
│ ├── APIHelper.php
│ ├── AuthClass.php
│ ├── DBClass.php
│ ├── Session.php
│ ├── UserClass.php
│ ├── WebsiteScannerClass.php
│ └── autoload.php
├── composer.json
├── composer.lock
├── config
│ └── DBConfig.php
├── includes
│ ├── _constants.php
│ ├── _helpers.php
│ ├── _login_check.php
│ └── _process.php
├── index.php
├── phpunit_mysql.xml
├── public
│ ├── ajax
│ └── sitemap.html
├── test.html
└── tests
    ├── HelloWorldTest.php
    ├── ScannerClassTest.php
    └── bootstrap.php

13 directories, 25 files


```

- **admin**: Contains files related to administrative tasks and functionality.
    - **ajax**: Handles AJAX-related functionality.
    - **crons**: Manages cron jobs.
    - **dashboard.php**: Implements the administrative dashboard.

- **assets**: Contains assets such as images, CSS, and JavaScript files.
    - **landing-page**: Holds assets specific to the landing page.
    - **user-portal**: Contains assets for the user portal.

- **classes**: Includes various PHP classes that provide functionality for the project.
    - **APIHelper.php**: Assists with API response filtering.
    - **AuthClass.php**: Handles user authentication.
    - **DBClass.php**: Interacts with the database.
    - **Session.php**: Manages user sessions.
    - **UserClass.php**: Implements user-related functionality.
    - **WebsiteScannerClass.php**: Implements the URL homepage scanning functionality.
    - **autoload.php**: Autoloads classes using Composer.

- **composer.json** and **composer.lock**: Files related to Composer dependency management.

- **config**: Contains configuration files.
    - **DBConfig.php**: Stores database configuration settings.

- **includes**: Holds various PHP include files.
    - **_constants.php**: Defines project-specific constants.
    - **_helpers.php**: Provides helper functions.
    - **_login_check.php**: Performs login-related checks.
    - **_process.php**: Processes form submissions.

- **public**: Contains files accessible to the public.
    - **ajax**: Handles public AJAX requests.
    - **sitemap.html**: Stores the sitemap HTML file.

- **tests**: Includes test files to ensure proper functionality.
    - **HelloWorldTest.php**: Tests the HelloWorld functionality.
    - **ScannerClassTest.php**: Tests the URL homepage scanning class.
    - **bootstrap.php**: Sets up the test environment.

- **HelloWorld.php**: A sample file showcasing the project's functionality.
- **index.php**: The main entry point of the project.
- **phpunit_mysql.xml**: Configuration file for PHPUnit tests.
- **README.md**: Provides information and instructions about the project.

## Conclusion

The URL Homepage Scanner project offers a powerful tool to scan and extract internal links from a provided URL's
homepage.
By leveraging this project,users can gain valuable insights into the internal structure and organization of websites and
help solve part of their SEO problems.

## Author
Samuel Ladapo
https://www.linkedin.com/in/ladapo-samuel/
