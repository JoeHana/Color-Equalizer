# Colorizer
Simple PHP Script to return desired color shades of a given color

## How to use

### 1. Include Class
Simply include the class in your project

#### Example:
```php
require 'vendor/colorizer/colorizer.php';
```

### 2. Use Funtion

```php
colorizer( $color, $modifier )
```

**$color** (required)
- String
- RGB Color Value

**$modifier**
- Array
- Array of Modifiers like type, change and opacity

## Examples

### Example 1:

The following example takes a slight grey rgb color code and applies an opacity of .5 to it.

```php
$color = 'rgb( 200, 200, 200 )';
$modifier = array(
	'opacity' => '.5'
);

colorizer( $color, $modifier );
```

or

```php
colorizer( 'rgb( 200, 200, 200 )', array( 'opacity' => '.5' ) );
```

### Example 2:

The following example takes a slight grey rgb color code, makes it darker and applies an opacity of .5 to it.

```php
$color = 'rgb( 200, 200, 200 )';
$modifier = array(
	'type'		=> 'darker',
	'change'	 => 50
	'opacity'	 => '.5'
);

colorizer( $color, $modifier );
```

or

```php
colorizer( 'rgb( 200, 200, 200 )', array( 'type' => 'darker', 'change' => 50, opacity' => '.5' ) );
```