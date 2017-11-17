# eflag-php
# Usage
```php
<?php
$flag=new EasyFlag(5);

echo(json_encode($flag->zuhe(1)))."\n";
echo(json_encode($flag->zuhe(2)))."\n";
echo(json_encode($flag->zuhe(3)))."\n";
echo(json_encode($flag->zuhe(4)))."\n";
echo(json_encode($flag->zuhe(5)))."\n";
echo(json_encode($flag->search([2])))."\n";
echo(json_encode($flag->encode([1,2,4,8])))."\n";
echo(json_encode($flag->decode(15)))."\n";

```
output:
```
[[1],[2],[4],[8],[16]]
[[2,1],[4,1],[8,1],[16,1],[4,2],[8,2],[16,2],[8,4],[16,4],[16,8]]
[[4,2,1],[8,2,1],[16,2,1],[8,4,1],[16,4,1],[16,8,1],[8,4,2],[16,4,2],[16,8,2],[16,8,4]]
[[8,4,2,1],[16,4,2,1],[16,8,2,1],[16,8,4,1],[16,8,4,2]]
[[16,8,4,2,1]]
[2,3,6,10,18,7,11,19,14,22,26,15,23,27,30,31]
15
[1,2,4,8]
```
