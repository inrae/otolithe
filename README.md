# Otolithe

Otolith is an application designed to facilitate the dating of calcified fish pieces (scales, otoliths, fin rays, etc.). Operators can position points on photos of the pieces, and it is possible to display all the readings taken.

## Installation

The application has been developed in PHP using the Codeigniter framework and the equinton/ppci library. It requires a Postgresql database, an Apache server and php 8.3.

The install/deploy.sh script is used to install the application almost automatically on a new server. It installs the necessary packages, retrieves the application code, creates the database and pre-configures the system.

Migration from versions prior to v24.0.0 requires you to recreate a new folder and transfer the connection parameters to the .env file at the root of the application.
