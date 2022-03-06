## Invoice

A plugin to list order data in a separate page.

Create a page, copy its id to the plugin settings.
Order data is available via placeholders (the same as in order_report.tpl): [+order.id+], [+order.fields.street+] and so on. 
To list cart contents use Cart snippet with instance=\`order\` parameter.

To build invoice link use order id and order hash:
```
https://sitename.ru/invoice/[+order.id+]/[+order.hash+]/
```
