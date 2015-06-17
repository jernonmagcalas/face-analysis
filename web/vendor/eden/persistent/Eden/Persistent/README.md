#Persistent

Session and Cookie classes in *Eden* was mainly included as a wrapper for these variables. Both session and cookie classes can be accessed as arrays in the following manner.

**Figure 1. Sessions and cookies as arrays**

	$session = eden('session')->start();     //instantiate
	 
	$session['name'] = 'value';         //set 'name' to 'value' in session data
	echo $session['name'];              //get session data where key is 'name'
	unset($session['name']);            //unset session data where key is 'name'
	isset($session['name']);            //returns true if a key called 'name' exists
	 
	foreach($session as $key => $value) {}   //loop through session data
	 
	echo $session; // outputs a json version of the session data
	 
	$cookie = eden('cookie');           //instantiate
	 
	$cookie['name'] = 'value';          //set 'name' to 'value' in session data (no expiration)
	echo $cookie['name'];               //get session data where key is 'name'
	unset($cookie['name']);             //unset session data where key is 'name'
	isset($cookie['name']);             //returns true if a key called 'name' exists
	 
	foreach($cookie as $key => $value) {}    //loop through cookie data
	 
	echo $cookie; // outputs a json version of the cookie data

*Eden's* session object directly works with PHP's $_SESSION property, so setting properties in either way will do the exact same thing. Similar to sessions, cookies work in the exact same manor. Both were created to compliment these PHP variables.

**Figure 2. Session Methods**

	$session->start();                   //starts session
	$session->getId();                   //get session id
	 
	$session->set('name', 'value');      //set 'name' to 'value' in session data
	$session->get('name');               //get session data where key is 'name'
	$session->remove('name');            //unset session data where key is name
	$session->clear();                   //remove all session data

**Figure 3. Cookies Methods**

	$cookie->set('name', 'value');       //set 'name' to 'value' in cookie data
	$cookie->set('name', 'value', 3600, 'some/path', 'openovate.com');   //set 'name' to 'value' located in some/path in openovate.com, expires in 1 hour
	$cookie->setSecure('name', 'value'); //set 'name' to 'value' in cookie data securely
	$cookie->get('name');                //get cookie data where key is 'name'
	$cookie->remove('name');         //unset cookie data where key is name
	$cookie->clear();                    //remove all cookie data

====

#Contributing to Eden

##Setting up your machine with the Eden repository and your fork

1. Fork the main Eden repository (https://github.com/Eden-PHP/Persistent)
2. Fire up your local terminal and clone the *MAIN EDEN REPOSITORY* (git clone git://github.com/Eden-PHP/Persistent.git)
3. Add your *FORKED EDEN REPOSITORY* as a remote (git remote add fork git@github.com:*github_username*/Persistent.git)

##Making pull requests

1. Before anything, make sure to update the *MAIN EDEN REPOSITORY*. (git checkout master; git pull origin master)
2. If PHP Unit testing is included in this package please make sure to update it and run the test to ensure everything still works (phpunit)
3. Once updated with the latest code, create a new branch with a branch name describing what your changes are (git checkout -b bugfix/fix-twitter-auth)
    Possible types:
    - bugfix
    - feature
    - improvement
4. Make your code changes. Always make sure to sign-off (-s) on all commits made (git commit -s -m "Commit message")
5. Once you've committed all the code to this branch, push the branch to your *FORKED EDEN REPOSITORY* (git push fork bugfix/fix-twitter-auth)
6. Go back to your *FORKED EDEN REPOSITORY* on GitHub and submit a pull request.
7. An Eden developer will review your code and merge it in when it has been classified as suitable.