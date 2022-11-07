## Search Class Usage
The Search::find($query, $id_lang) method allows you to search within products and categories.<br /><br />
The method returns an array, which contains the products and categories keys. The id values of the records matching the search query are returned under these products and categories keys.<br /><br />
If nothing is found in the search result, an empty array is returned for the products and categories keys in the returned array.
> ```Search::find($query, $id_lang)``` returns array('products => [...], ''categories' => [...])

&larr; [Configuration Class Usage](09-configuration-class-usage.md) | [Image Class Usage](11-image-class-usage.md) &rarr;
