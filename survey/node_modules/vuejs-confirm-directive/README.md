# Vue.js Confirm directive

A confirmation is always required on tasks which if a user takes, can have certain consequences. For example deleting a user, publishing an article and many such things. Creating a confirmation box to show a message and make the user aware is important.

This directive will help create a confirmation box for the user with a custom alert message and then allow to handle the action.

There exist a lot of components which gives you buttons but why should we restrict a user to a button. Can be any HTML element like image. And hence, this directive.

## Installation
#### using NPM:
```js
npm i vuejs-confirm-directive
```

#### using Yarn:
```js
yarn add vuejs-confirm-directive
```

## Usage
You can do a require in your main js and then use the directive anywhere in the
application.

```
require('vuejs-confirm-directive');
```

### Example 1 - get confirmation, send post data and reload page
```
<button v-confirm.reload="{
    link: 'your-url-comes-here',
    message: 'Your custom message comes here',
    data: {name: 'Custom directive', short: 'v-confirm'},
}"></button>
```

### Example 2 - get confirmation, send post data and handle the callback
```
<button v-confirm="{
    link: 'your-url-comes-here',
    message: 'Your custom message comes here',
    data: {name: 'Custom directive', short: 'v-confirm'},
    callback: functionToHandleCallback
}"></button>
```

### Example 3 - get confirmation, and do nothing
```
<button v-confirm="{
    link: 'your-url-comes-here',
    message: 'Your custom message comes here',
    data: {name: 'Custom directive', short: 'v-confirm'},
    callback: null
}"></button>
```

## Options / attributes to send with the directive
Below is a list of attributes that you can send and what that does.

| Props | Type | Optional | Options |
| ----- | ---- | -------- | ------- |
| link | String | required | any valid url
| message | String | required | custom message
| data | Object | optional | payload to the post url
| callback | function | optional | function or name of function

**NOTE:** When the reload modifier is not provided, a callback function is
required. If, for any situation you don't want to handle the confirm of user
(which I feel is a rare case) pass null or false to the callback property.
