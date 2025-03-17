The simple HidePrice module allows to hide prices for certain customer groups, with the possibility to simplify price loading process for performance purposes.

'Add To Cart' button
-   It can be hidden, in cases of both 'enabled' and 'non-enabled' hide-price functionality 
- It is independent of the setting for 'Hide Price Enabled', which means in case you set 'enabled' for hide-price functionality, 'Add To Cart' button is not automatically disabled.

Price Load
- Behind the stage, many types of prices are still loaded though no prices are shown on the front page. For this reason, this module adds possibility to simplify the load for some specific heavy-load prices.
- For example, 
  - Base Price is the min value of various price types (regular price, special price, catalog rule price, ...). When prices are hidden, and base price is not needed in other modules, the removal of the load of difference prices and 
  comparison among these prices can add positive effect to the page performance.
  - Final Price uses the value of Base Price. In case, Final Price is not used at all, it's good practice to simplify how it is loaded.

Detailed module guide and explanation:
[User guide](./panca-hide-price-100.0.0-user-guide.pdf)

