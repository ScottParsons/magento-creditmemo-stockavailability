# Magento - Credit Memo Stock Availability Module

## Overview

A Magento module that, upon issuing a Credit Memo, will correctly set product availability back to ```In Stock``` in 
addition to returning the quantity, should the product become ```Out of Stock``` when ordered.

## Requirements

Magento Open Source (CE) Version 1.7.x, 1.8.x, 1.9.x

## Installation

Prior to installing the module, ensure that compilation is disabled.

```System -> Tools -> Compilation```

Copy the contents into your Magento project directory and refresh the cache.

## Usage

Within the admin, head to ```System -> Configuration -> Catalog -> Inventory```, expand the ```Product Stock Options``` 
section and enable the ```Update Product Stock Availability``` option.
