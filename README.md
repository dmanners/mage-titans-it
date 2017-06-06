# How to un-Magento your Magento code

Mage Titans Italy workshop 2017 by David Manners

## What

1. Define your objects in your domain,
2. What is a X for you?
3. Design first then develop,

## Why

1. Free your mind/design,
2. Control your decisions,
3. Add migration possibility,

## When

1. Import/Export,
2. WebAPI,
3. Extension creation,
4. Headless frontend,

## How

1. Product design,
2. CLI,
3. Serilizer,

## What is a product?

```
[
    {
        "sku": "sample-product-1",
        "title": "Sample Product1",
        "price": 2.3,
        "stock": {
            "inStock": true,
            "stockLevel": 120
        }
    },
    {
        "sku": "sample-product-2",
        "title": "Sample Product2",
        "price": 8.25,
        "stock": {
            "inStock": false,
            "stockLevel": 0
        }
    },
]
```

## Links

https://www.schmengler-se.de/en/2016/12/learn-refactoring-to-framework-independent-code/
https://www.integer-net.com/isolating-domain-logic-in-magento-customizations/