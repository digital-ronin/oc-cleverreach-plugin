CleverReach integration plugin

This plugin implements the MailChimp subscription form functionality for the [OctoberCMS](http://octobercms.com).

This plugin is a modified version of the [MailChimp plugin](https://github.com/rainlab/mailchimp-plugin) by [Rainlab](https://github.com/rainlab).

## Configuring

In order to use the plugin you need to get the API key from your [CleverReach account](http://www.cleverreach.com/).

1. In the OctoberCMS back-end go to the System / Settings page and click the CleverReach link. 
2. Paste the API key in the **CleverReach API key** field.

## Creating the Signup form

You can put the CleverReach signup form on any front-end page. Add the CleverReach Signup Form component to a page or layout. Click the added component and paste your CleverReach list identifier in the **CleverReach List ID** field. Close the Inspector and save the page. 

The simplest way to add the signup form is to use the component's default partial and the `{% component %}` tag. Add it to a page or layout where you want to display the form:

    {% component 'mailSignup' %}

If the default partial is not suitable for your website, replace the component tag with custom code, for example:

    <form
        id="subscribe-form"
        data-request="mailSignup::onSignup"
        data-request-update="'mailSignup::result': '#subscribe-form'"
    >
        <input type="text" name="email" placeholder="Newsletter subscription">
        <input type="submit" class="btn btn-default" value="Subscribe"/>
    </form>

The example uses the standard partial mailSignup::result for displaying the subscription confirmation message. If you don't like the standard message you can create your own partial in your theme and specify its name in the `data-request-update` attribute. The default partial is located in `plugins/digitalronin/cleverreach/components/signup/result.htm`.

More fields can be included in the subscription request:
    
    <input type="text" name="merge[fname]" placeholder="First Name" />
    <input type="text" name="merge[lname]" placeholder="Last Name" />

That's it!