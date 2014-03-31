<?php

View::composer(array('user.profile'), 'Cvp\Composers\User\UserProfileComposer');
View::composer(array('user.create', 'user.register'), 'Cvp\Composers\User\UserCreateComposer');
View::composer(array('user.edit', 'user.edit'), 'Cvp\Composers\User\UserEditComposer');

View::composer(array('city.promotions'), 'Cvp\Composers\City\CityIndexComposer');

View::composer(array('deal.detail'), 'Cvp\Composers\Deal\DealDetailComposer');