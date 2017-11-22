# Template-Library

A PHP library of WordPress atoms and organisms engineered for writing standardized markup quickly. Most atoms include a WordPress template tag and the markup to surround the content returned from the template tag. For instance, the atom PostTitle returns content from the WordPress function the_title();, contained inside an h2 tag by default.

Every piece of the atom, from the tag to the content is configurable in the atom arguments, and can be filtered separately if access to the main arguments is not available. Finally, atoms can stack together to form organisms, which makes writing markup for a WordPress theme faster and cleaner. This way, you won't have to contend with a forest of open and close PHP tags, or odd indenting and bizarre if statement nesting. All of these things distract from the heart of the markup: the content. The WordPress Template Library brings clarity to markup.
