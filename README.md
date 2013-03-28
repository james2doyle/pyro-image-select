pyro-image-select
=================

Visually select images using a field type in PyroCMS

![Creating the field](https://raw.github.com/james2doyle/pyro-image-select/master/screen1.png)

![No Image Chosen](https://raw.github.com/james2doyle/pyro-image-select/master/screen2.png)

![Image Selected](https://raw.github.com/james2doyle/pyro-image-select/master/screen3.png)

How To Use
----------

### Basics

* Add the field type as you would normally
* Choose "Image Select" as the type
* Choose a parent folder to draw images from
* Enjoy it on a page

### In the layout

This field returns the image file that you selected. So it has all the properties you will need. But here is the basic usage.

``` html
{{ files:image id=my_chosen_slug.id }}
```

or maybe something a little more custom

``` html
<img src="{{my_chosen_slug.path}}" title="{{my_chosen_slug.name}}" id="{{my_chosen_slug.id}}">
```

Upcoming
--------

* Multi-Select
* Ordering

License
-------

(The MIT License)

Copyright (c) 2013 James Doyle(james2doyle) james2doyle@gmail.com

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
'Software'), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.