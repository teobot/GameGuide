# Frameworks - CodeIgniter
## Theo Jed Barber Clapperton
### 18055445

### Installation
1. Import the database located in "PHPFramework/application/SQL/18055445gamesreview.sql",
2. Start the webserver location at "PHPFramework/webserver/server.js",
3. Log in using username: "john" ; password: "henry,
4. Base_url is 'http://localhost/PHPFrameworks', So adjust folder location to reflect url, no port is used!

# Models
## CommentModel
### getComments // returns the comments of a review
### postComment // posts a comment on a review to the database
## HomeModel
### getGame // returns a array of the current game review from the database
### getReview // returns the data from a specific review based on the slug
## LoginModel
### userExists // takes a username and password, to check if a user userExists
### userLoggedIn // returns true if the user is logged in, else false
### insertNewUser // takes a username and password, and creates a user in the database
### getAccount // returns the user information based on the given userID
### usernameTaken // returns true if the given username is already taken
### updateUserDetails // updates the given userID with the provided username and password
## UserAccount
### setAccountType // sets the user provided with the provided account setAccount
### isUserAdmin // checks the given userID if the user is a isUserAdmin
### darkModeEnabled // checks if the given userID has enabled darkModeEnabled
### setProfileImage // sets the profile image for the given userID
### setDarkMode // enables or disables darkMode for the given userID

# Views
## header // displays the navbar, imports styling scripts
## footer // displays the chatModel, imports custom JS scripts
## account // View for the account page information
## home // view for the landing page of the website
## login // allows the user to login to the website
## register // allows a user to create a new account and Login
## review // displays the review information on the specific game review

# Controllers
## Account
### index // Displays the correct information into the form
### updateAccount // Updates the account with the submitted user data
### setAdmin // sets the accountType of the logged in user
### setDarkMode // sets darkMode for the logged in user
### getAccountDetails // gets the account details if the user is logged in and JSON encodes them

## Home
### index // Landing page of the website, displays all the current reviews to the home page
### get_Comments // gets the comments for the specific review and JSON encodes them for VueJS
### post_comment // posts the posted comment and slug to the database to be added as a comment
### review // This is the page that displays the review information, shows 404 if the review data is empty

## Login
### notyou // deletes the current cookies and redirects home
### index // The login screen, allows users to login to the system to post comments and enabled darkmode/admin Model
### register // This is the signUp screen, this page displays the register form for the sign to create a account
