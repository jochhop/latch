#Latch Integration for Magento Community Edition#

### What is this extension for? ###
* If you don't know what is Latch, please first read their official documentation here: https://latch.elevenpaths.com/www/service.html
* The extension adds an extra feature for your Magento security thanks to Latch.
* Customers and administrators sessions will be doubly protected.
	
### How the extension works ###
* Basically, when the customer or administrator wants to log in Magento, the extension fires Latch and checks if this is enabled. If it is, the log in process will be refused and a warning will be sent to the customer/adminitrator in Latch app.
* This makes that only the customer or administrator that wants to use his/her account will be able to control his/her sessions accesses.
		
### How to install in Magento CE ###
* Actually I have tested it only in Magento CE 1.9.2 but I will test it also as soon as possible in other versions. The extension does not override classes or core functionalities, it is made by observers. So probably it will work fine for other older versions.
* Copy and paste the files on your Magento's root folder installation.
* If you don't know what is modman or don't use it, you can skip this file.

### How to configure it ###
##### For customers: #####
* Once the customer have already an account created, there will be a new tab in customer dashboard with Latch settings. There the customer will can type the token and pair his/her account with Latch.
* Once the account is paired, the customer will be able to unpair his/her account under the same tab of above.

##### For administrators: #####
* Administrator can pair Latch accounts by the administration panel under System > Permissions > Users > Clicking on an user. There will be a new tab for Latch settings. The process is the same as for customers.

#### Languages and support: ####
* The extension already provides English and Spanish languages and Polish is on the way.
* If you find a bug or have a suggestion please write me here: joc.latch.magento@gmail.com or by my twitter account @joc_hhop
