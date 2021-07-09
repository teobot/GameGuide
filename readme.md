# GameGuide
A game review service written using CodeIgniter.

![Image of the title](https://raw.githubusercontent.com/teobot/GameGuide/master/GameGuide-min.png)

*Written In*: **PHP CodeIgniter, Node.JS, MYSQL**  
*Style Guide*: **Prettier**  
*Linter*: **ESlint**  
*Version*: **`1.0.0`**  
*Github Repo Link*: ***[Github Link][https://github.com/teobot/GameGuide]***  

## Table of Contents
- [GameGuide](#gameguide)
  - [Introduction](#introduction)
    - [What is this project?](#what-is-this-project)
    - [What grade did you get? - **✨100%✨**](#what-grade-did-you-get---100)
      - [What did the examiner say?](#what-did-the-examiner-say)
  - [Usage](#usage)
    - [Getting started](#getting-started)
    - [Logging In](#logging-in)
  - [What does it look like?](#what-does-it-look-like)
  - [Models, Views and Controllers](#models-views-and-controllers)
    - [Models](#models)
      - [CommentModel](#commentmodel)
      - [HomeModel](#homemodel)
      - [LoginModel](#loginmodel)
      - [UserAccount](#useraccount)
    - [Views](#views)
    - [Controllers](#controllers)
      - [Account](#account)
      - [Home](#home)
      - [Login](#login)
  - [Author](#author)

## Introduction
### What is this project?
This project is a computer game review website. This project uses the PHP language more specifically the PHP framework called CodeIgniter and follows the MVC framework. It also includes a Node.Js server that allows users to chat to each other in real time.

### What grade did you get? - **✨100%✨**
I got **✨100%✨**, I put a lot of effort and time into this project and I believe it came out really well.

#### What did the examiner say?
> "I have little constructive feedback to provide due to the quality of your application. You have gone above and beyond to produce a webpage that is not far off industry standard. Exceptional submission. You should be proud of your effort.
" ***- John Henry***

## Usage
### Getting started
Before running the problem follow the following steps
1. Import the database located in `/application/SQL/18055445gamesreview.sql`,
2. Start the node webserver location at `/webserver/server.js`,
   - Using the `node server.js` command
3. The `base_url` is `http://localhost/PHPFrameworks` in `/application/config/config/config.php`
    - If you are using a different hostname or folder name you will need to change this.

### Logging In
You can log into the system using the following profile
- username: `john`
- password: `henry`


## What does it look like?


## Models, Views and Controllers
### Models
#### CommentModel
- getComments returns the comments of a review
- postComment // posts a comment on a review to the database
#### HomeModel
- getGame // returns a array of the current game review from the database
- getReview // returns the data from a specific review based on the slug
#### LoginModel
- userExists // takes a username and password, to check if a user userExists
- userLoggedIn // returns true if the user is logged in, else false
- insertNewUser // takes a username and password, and creates a user in the database
- getAccount // returns the user information based on the given userID
- usernameTaken // returns true if the given username is already taken
- updateUserDetails // updates the given userID with the provided username and password
#### UserAccount
- setAccountType // sets the user provided with the provided account setAccount
- isUserAdmin // checks the given userID if the user is a isUserAdmin
- darkModeEnabled // checks if the given userID has enabled darkModeEnabled
- setProfileImage // sets the profile image for the given userID
- setDarkMode // enables or disables darkMode for the given userID
### Views
- header // displays the navbar, imports styling scripts
- footer // displays the chatModel, imports custom JS scripts
- account // View for the account page information
- home // view for the landing page of the website
- login // allows the user to login to the website
- register // allows a user to create a new account and Login
- review // displays the review information on the specific game review
### Controllers
#### Account
- index // Displays the correct information into the form
- updateAccount // Updates the account with the submitted user data
- setAdmin // sets the accountType of the logged in user
- setDarkMode // sets darkMode for the logged in user
- getAccountDetails // gets the account details if the user is logged in and JSON encodes them
#### Home
- index // Landing page of the website, displays all the current reviews to the home page
- get_Comments // gets the comments for the specific review and JSON encodes them for VueJS
- post_comment // posts the posted comment and slug to the database to be added as a comment
- review // This is the page that displays the review information, shows 404 if the review data is empty
#### Login
- notyou // deletes the current cookies and redirects home
- index // The login screen, allows users to login to the system to post comments and enabled darkmode/admin Model
- register // This is the signUp screen, this page displays the register form for the sign to create a account


## Author
👤 **Theo Clapperton**
- Website: https://theoclapperton-portfolio.netlify.app/
- Github: [@teobot](https://github.com/teobot)
- LinkedIn: [@theoclapperton](https://linkedin.com/in/theoclapperton)
