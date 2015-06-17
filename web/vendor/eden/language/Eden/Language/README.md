# Languages

Languages in *Eden* are fairly robust, simply defined and designed to work with other translating services such as *Google Translate*. The follow figure shows how to set up a french translator.

**Figure 1. French Translator**

	//initial translations
	$translations = array(
		'Hello'         => 'Bonjour',
		'How are you?'  => 'Como tale vous?');
	 
	//load up the translation   
	$french = eden('language', $translations);
	 
	//you can add translations on the fly
	$french->translate('I am good thank you, and you?', 'Bien mercy, et vous?');
	 
	//now echo some translations
	echo $french->get('Hello'); //--> Bonjour
	echo $french->get('How are you?'); //--> Como tale vous?
	echo $french->get('I am good thank you, and you?'); //--> Bien mercy, et vous?

For ease of use we also made the language object accessable as an array. The next figure shows the same as `Figure 1` except that it's usings arrays to manipulate the object.

**Figure 2. Languages as Arrays**

	//initial translations
	$translations = array(
		'Hello'         => 'Bonjour',
		'How are you?'  => 'Como tale vous?');
	 
	//load up the translation   
	$french = eden('language', $translations);
	 
	//you can add translations on the fly
	$french['I am good thank you, and you?] = 'Bien mercy, et vous?';
	 
	//now echo some translations
	echo $french['Hello']; //--> Bonjour
	echo $french['How are you?']; //--> Como tale vous?
	echo $french['I am good thank you, and you?']; //--> Bien mercy, et vous?
	 
	foreach($french as $default => $translation) {
		echo $translation;
	}

Most commonly, websites using languages usually start and end with loading and saving translation files. Using *Eden's* language object through the life of the page and later saving will keep your languages file always up to date.

> **Note:** Eden does not do the actual translating on its own. Once the file is generated and saved you should run it through a translating service.

**Figure 3. Loading and Saving a Language File**

	//load up a translation file
	$translations = eden('file', '/path/to/french.php')->getData();
	$french = eden('language', $translations);
	 
	//add to translation
	$french['I am good thank you, and you?] = 'Bien mercy, et vous?';
	 
	//save back to file
	$french->save('/path/to/french.php');

====

#Contributing to Eden

##Setting up your machine with the Eden repository and your fork

1. Fork the main Eden repository (https://github.com/Eden-PHP/Language)
2. Fire up your local terminal and clone the *MAIN EDEN REPOSITORY* (git clone git://github.com/Eden-PHP/Language.git)
3. Add your *FORKED EDEN REPOSITORY* as a remote (git remote add fork git@github.com:*github_username*/Language.git)

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