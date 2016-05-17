# phillips-hue-connection
Provides basic functionality for the Philllips Hue debug API

__Installation__

````
composer require dsteiner23/phillips-hue-connection
````


__Usage__

````
/**
 * Class Hue
 * @package App\Http\Controllers
 */
class HueController extends Controller
{
    public function test(LightSwitchInterface $lightSwitch)
    {
        $lightSwitch->switchState(5, 150, 150, 7500);
    }
}
````
