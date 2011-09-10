# BostonPHP - Meetup Checkin and Raffle App

## Introduction
We love to give away prizes at our BostonPHP meetup events! To make it quick and fun, we built an app that picks a winner from the list of attendees with a quick animation. 

This app has 2 parts. The first part lets people 'check in' by clicking their name from a list pulled from the meetup.com site using their API.

The second part is the raffle, where a random winner is selected from the people who have checked in.

## Setting up
You will need to be the admin of a group on Meetup.com. Go to http://www.meetup.com/meetup_api/ to read more about the meetup API.

Make a copy oc the core.local.php.backup file called core.local.php. Open this and enter your meetup API in the designated spot. Also, enter a username and password for the admin login.

Create an empty MySQL database (pick any name). 

Make a copy of database.php.backup called database.php and edit the database credentials so the application can log into the database you just created.

Once you've done that, setup your database with the tables by running the SQL script in the file /app/config/database_setup.sql


## How to use the app

### Before the event - setting up as Admin
Just before the event, you will need to import the users who have RSVP'd. Go to the home page, click 'admin' and enter your username/password

If your meetup group has an event scheduled, it will appear in the drop-down on the /admin page. Select the upcoming event and click 'import'.

The page will refresh, when you are ready to start letting people checkin, click the 'activate' link next to the event name. Then click the RSVP link in the upper right - it's time for people to check in!

### As User
Just click on your picture! That's it. If you are having trouble finding your name, you can use the search box. Remember, it's the name you signed up for with the meetup site.

### To run the raffle
Click the admin link. Above the drop-down menu, click the 'raffle' link. This will bring you to the raffle page with all the people who have checked in with a giant 'pick a winner' button. 

Click the button and watch the winner get chosen!

To choose another winner, simply refresh the page and click the big button again.

## Demo
Preview of the winner selection: http://adrane.com/raffle_demo/raffle.html

This partial preview is static (it selects the same winner each time) but gives a taste of what it's like to pick a winner at the end of your meetup!

## Upcoming impovements
- Winner's circle at the top, save winners to database to prevent people from winning twice.
- Branding configuration - specific meetup names should be in a config file so it's easier to set-up for other meetups.
- Merge public branch
