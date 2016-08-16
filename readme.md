# Craft Easy Email
Easy Email is a minimal but powerful email sender that uses variables defined from a POST request. You get to use almost all attributes defined in Craft's [EmailModel](https://craftcms.com/classreference/models/EmailModel) along with a few additional fields to make your life easier! Just name your inputs accordingly and it just works!

## Usage
1. Add the form action `<input type="hidden" name="action" value="easyEmail/send">`.
2. Define a template to use to render the email `<input type="hidden" name="template" value="_emails/share-page">` (use this instead of using `body` & `htmlBody`).
3. Reference Craft's [EmailModel](https://craftcms.com/classreference/models/EmailModel) to set any additional fields (Both `toEmail` & `subject` are required).
4. Add a redirect `<input type="hidden" name="redirect" value="/thanks">`.
5. Add any other custom fields.
6. Denote your required custom fields `<input type="hidden" name="required" value="fromName|toFirstName|toEmail|message">`.

In both your email template and `subject` field, you have the ability to use any variable defined in your form. If using variables in your subject just use the single handlebar syntax (`{}`) syntax.

## Example

```
<form class="c-form" method="POST">
    <input type="hidden" name="action" value="easyEmail/send">
    <input type="hidden" name="template" value="_emails/share-page">
    <input type="hidden" name="fromEmail" value="{{ craft.systemSettings.email.emailAddress }}">
    <input type="hidden" name="subject" value="{fromName} wants you to check out this page on {siteName}!">
    <input type="hidden" name="redirect" value="/thanks">
    <input type="hidden" name="required" value="fromName|toFirstName|toEmail|message">
    <input type="hidden" name="articleUrl" value="{{ url }}">
    <div class="c-form__group">
        <label for="fromName">Your Name</label>
        <input type="text" name="fromName">
    </div>
    <div class="c-form__group">
        <label for="toFirstName">Friend's Name</label>
        <input type="text" name="toFirstName">
    </div>
    <div class="c-form__group">
        <label for="toEmail">Friend's Email</label>
        <input type="email" name="toEmail">
    </div>
    <div class="c-form__group">
        <label for="message">Message</label>
        <textarea name="message" placeholder="Tell them what you think..."></textarea>
    </div>
    <div class="c-form__group">
        <input type="submit" value="Send">
    </div>
</form>
```

## Installation
1. Download & unzip the file and place the `easyemail` directory into your `craft/plugins` directory
2.  -OR- do a `git@github.com:nicholasodo/craft-easyemail.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`
4. Install plugin in the Craft Control Panel under Settings > Plugins
5. The plugin folder should be named `easyemail` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.