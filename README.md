## About

allearstravel.com (which has since been registered all allearstravel.co.uk) was a project I embarked on in early 2024, trying to build a prototype based on Laravel to:
* Check availability of rooms at Disney Resorts using the RateHawk API (https://github.com/jlo093/allearstravel.com/tree/master/app/Services/RateHawk)
* Check rates provided by Disney officially by scraping their website (https://github.com/jlo093/allearstravel.com/blob/master/app/Services/Disney/DisneyWebscraper.php)
* Determine a price to use (https://github.com/jlo093/allearstravel.com/blob/master/app/Services/Internal/DynamicPricingService.php)

and then of course all sorts of controllers/views to build a basic website to test all of that. The plan was to later on build a separate front end based on Vue or React and turn the project into a micro service/API only.
