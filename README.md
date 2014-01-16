# FrequenceWebCalendRBundle [![Build Status](https://secure.travis-ci.org/frequence-web/FrequenceWebCalendRBundle.png?branch=master)](http://travis-ci.org/frequence-web/FrequenceWebCalendRBundle)

This bundle provides [CalendR](http://github.com/yohang/CalendR.git) integration.

It allows you to manage calendar and events.

Calendar generation
--------------------

### Controller:

```php

/**
 * @Template()
 */
public function indexAction()
{
    return array('month' => $this->get('calendr')->getMonth(2012, 01));
}

```

### Template

```html

<table>

    {% for week in month %}
        <tr>
            {% for day in week %}
                <td>
                    {% if month.contains(day.begin) %}
                        {{ day.begin.format('d') }}
                    {% else %}
                        &nbsp;
                    {% endif %}
                </td>
            {% endfor %}
        </tr>
    {% endfor %}

</table>

```

Event management
----------------

### Providers

To manage your events, you have to create a provider and an event class. See [CalendR doc](http://github.com/yohang/CalendR)

### Declare your provider

This bundle allows you to easily add your providers to the CalendR event manager. Your provider have to be a service.


```yaml
#config.yml

services:
    my_event_provider:
        class: Your\Bundle\Event\Provider
        tags:
            - { name: calendr.event_provider }

```
