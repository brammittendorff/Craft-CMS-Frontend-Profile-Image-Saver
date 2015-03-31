# Craft CMS Frontend Profile Image Saver
You need to use a REST client and create a post to your plugin for testing. (remember posting will only work in dev mode, because if it is live you will need ajax calls)

This comes in handy when you use Aviary:
https://developers.aviary.com/docs/web/example

--

call to url (POST):

/actions/aviaryFrontend/image/saveImage

payload:

url=http%3A%2F%2Florempixel.com%2F400%2F200%2F

--

usage:

url=[IMAGE URL]

and it will be automaticly saved as your loggedin userprofile image
