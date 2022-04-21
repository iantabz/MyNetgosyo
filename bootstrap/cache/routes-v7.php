<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ffho1uAZHkBK7wbx',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9T4ETqzFSSElk45Q',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RaTLWXhzoyVznpOQ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ivil0uBgawqajwal',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/add_new_user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::inTnx3t9qyuOnSM3',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/getUser' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8yuhtlMzz8yR26MI',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/getUser/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::i0AOZbVQefFlUpA9',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/getUserAcct' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::piEYuRSA2NooFfAy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/getUserAcct/usersAcct' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yzPS5x6kzjsz3EJ4',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/getAdmin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lN4nDrdZXWi9z0Wi',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/getAdmin/admin' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::16TURyEUsFvGdskW',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/getHepedeViaje' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ephPQkwJJ3QnTrgF',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/getHepedeViaje/hepedeviaje' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dA0NyB7pbjH34xsf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/getSalesman' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::w8SwfucS2u4DMkgU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/getSalesman/salesman' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bzMEJyMw3Btz7rp1',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/getCustomer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tvBIQb7vObjN9W2r',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/getCustomer/customer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DEdtIBO1nMUhqT2P',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/get_month' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KOjiJtbzxNEYios2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user/get_year' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tvVNoNAqNMexRkVe',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/consolidated/getConsolidated' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eOxTs70fFHShtxTK',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/consolidated/getConsolidated/consolidated' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uR1aOXp8GBKEdoXD',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/consolidated/generate_si_test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VeR8ovXihB7kdZun',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/saved_item_image' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Gov0K4ucL0qubTx1',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getItem' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oXkU1F0ogIX620C7',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getItem/item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jVjP5OLyLpYgkMXR',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/activate_item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::onK8RXkZWAqIXPVt',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/saved_item_image1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::i5nEbLbzfG2foBh0',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getItem1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tts2jSdfQmtnJjF7',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getItem1/item1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ePR2q3YUZJrEaAlZ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/activate_item1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YQrHbsHs1meAo5Qa',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getItem2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FODCsHwoUqA4VHWk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getItem2/item2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HMRP4ey7cBzCrIYk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/activate_item2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DmX6gR3ScjUnSi71',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getNoItem' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::W227wThDsNURVzGF',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getNoItem/noitem' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3sZSw5uyvVtUWo8H',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/drop_noitem' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iA5UnHdNqPfYTRDA',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getReturnedItems' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UD4akrYUD7Tl7vND',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getReturnedItems1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iDdHCPNB9AtVx7am',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getReturnedItems2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DlxeuGnnHvyNf7hj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getReturnedItems/item_returned' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fKW7s1H1ryXyo7m3',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getUnservedItems' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Kky3RPEU0y6GV3S3',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getUnservedItems/item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9A2HT1BSnmesmSU9',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getUnservedItems/print' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ETjZKVoMFiUyknsF',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getItemLog' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ieycdtfNBfErH4k0',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getItemLog/item_log' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FYfMmgVJW259L1s6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getItemDetailsLog/itemlogdetail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2VtbO0jcQC5gcSFd',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getOrderItem' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QbObKX34aIjxOxdU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/item/getOrderItem/item3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nQeADpaQpeNh6pYE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/messenger' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rcEO2nW72VpbaqOR',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ins95xNupW4amEKi',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/messenger/deactivate_chat' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::33xpFUll8EHxjXKC',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/messenger/create_new_chat' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Czx0RSBLhBQjLnlN',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tele_ordering/get_categories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RE5KZ8CPXCCStFyy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tele_ordering/get_customers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NawqApsHu9aIs8Gj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tele_ordering/getTransaction' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DINm8UAqQNpw6Z4w',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tele_ordering/getTransaction/addtrans' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xCewXGAzx09e9dJE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tele_ordering/additionalOrder' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VtMdYHYegvmOHsEQ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tele_ordering/cancelOrder' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Y1h8duaBZSUeNzp0',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tele_ordering/getCustomerInfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7TOaCuJr8YXpB3pu',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cut_off_time/set_time_cutoff' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MIYFt6si3EgZravp',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cut_off_time/get_time_setup' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lDX4JsgIwlpt2Blj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BprhiJZo3AyamY8L',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::l5YDBXbeHLe3mj9Y',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kBgcrW4pbDBYbfoO',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::755IIJqEu5GQ5aYz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OhT9coPHmRfV0ZUw',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction5' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::U3Ltg6XlyVbW59RR',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction6' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RADuyLIN63KSFzPB',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction7' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lOU3LsZaZXNSWwuQ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction/transaction' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZF3AKQWc4xfo5CyE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction/transaction1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jDbaGi9ubHKF8z6h',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction/transaction2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QNUeonp8ky0C79sA',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction/transaction3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FTtvsW1ABuRky1kR',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction/transaction4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sZyJ4ISZZ1cYzK3i',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction/transaction5' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vgOwOAoKOYccwOZj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction/transaction6' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Lt7bRZOcNOOZgD9K',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTransaction/transaction7' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eAvXtoZeXmPNdSrV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getOrderTransaction/order_detail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YeNDEs5GzzOASgq3',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getOrderTransaction/teleorder_detail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RYtLFD5CX3nsvsDG',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getOrder' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nOZeDkn6SLeEcMe3',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getOrder/order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jLKwlioqJ2ywBil2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getOrderTransaction1/order_detail1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HYmdD6xUTqlOdMBz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTotalAmount' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WsCyMJ2FaNIxmRJE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTotalAmountDel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BWFk9TnKEvSGk9xJ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTotalAmountRet' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HspHugXnBny4lSVu',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTotalAmountCanc' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::x70TExQdoPGSziN6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTotalAmountAdv' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::joJmvI2A8mu0lC3K',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTotalAll' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xe9F0H0gWZPzbtIj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTotalSubmitted' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ci21Bwxl47uR3pcZ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTotalOnProcess' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::f4tHiRE9ru3n3aRt',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTotalApproved' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6lc3SVAjCoR7PLk5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTotalDelivered' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rUwbnWvdha9FcPCE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTotalReturned' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6frpkHg9nu1R8paa',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTotalCancelled' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JOODnMiolfxAocPb',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/getTotalAdvanced' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VoYsuUoNY0Tk4Mcg',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/get-ongoing-transactions-count' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QnRj4ojTjbYz1HQK',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/advanced-orders-count' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gK7ipsRyWHV7IDKr',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/revert-transaction' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3hRmglhfGUIy7IIX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/transaction/delete-transaction' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RqqeENWRiyCPUfSS',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/getExportBcom' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CT1CuMpGrK7S1dDq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/getExportBcom/bcom' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vbJh5wLd6EnxENxY',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/getExportAris' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TLfHocxFvB1Gtc1s',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/getExportAris/aris' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::E7U1sSn6HRs243Wj',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/get_export_files_bcom' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3B2Pi8v78Q3YVOHX',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/get_export_files_bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1Ly8pvnrG6PaW1Ae',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/get_export_files_flowrack' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Gv18ue853zWNuQsi',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/get_export_files_bcom_unserved' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::N3RyzSDFDx8vl8vJ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/get_export_files_bulk_unserved' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WuclGFkqXWNHdfkJ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/get_export_files_flowrack_unserved' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wZ74AnmTCkg2QYBx',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/get_export_files_aris' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::186OG65bq571nVV2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/getExportBulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::neZk6EEtDpxBQdYv',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/getOrder/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lEPUfJ6Ln37fS9YS',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/getExportUnserved' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::r5CI0OGa74qeNgls',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export/getExportUnserved/unserved' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xvTN5stpTcot80na',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/import_masterfile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CpAdYbFPZzkGRZ94',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/import_csv_masterfile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ebmPSO6u5VX0qHTg',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/import_consolidated_masterfile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1E9cxudA6ejP5srz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_updated_list_item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::73RpSkxtfQqdZ9Ki',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_unupdatedlist_item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WgmhyzAieskX56of',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/create_customeraccnt' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mNFNgi6XJhDfGrxb',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/activate_customer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RXv5hf9pZQEj62ZN',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/api/persons/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ezncZFITJ1icTjJI',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/get_account_details' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3NMko2JdyZKtOJMh',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/getCustomers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FdArx10LAJ874zio',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/getCustomers2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rkw2vm3sMlUeoINh',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/getCustomers2/customer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ijn7tfludaSySeoI',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/update_customeraccnt' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WajEJt6zXkq71ZSJ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/import/customer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'customer_import',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/getSalesmanCode' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::n2U1hRIbCofzTQbO',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/getSalesmanDetails' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Te9rzjH2Oy4JXltz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/postCredit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zAeZhEyn1Iu2zubn',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/setDefaultPassword' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8ElFwhLvvvXVRlUB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/get_principal' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0vYfHkumoCnyNmRO',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/get_principal/name' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::P2k2N3QUIzrwDjxe',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/postDiscount' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::n1IUL2mMzrhbY7Zl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/getPList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aRqY9mfVEpYXIjVR',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/getPList/name' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KXvfltTviMMTtoUo',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/tagPList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OYYGlACoUjWoLzMx',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer/forPrint' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EGqZ35iLe2l6n95L',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account_group_codes/create_group_code' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wsNDAXvmIVFAfB7W',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/account_group_codes/get_account_group_codes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xuBNjTftGNeJAb1N',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman/get_salesman_list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TBHTqcZwCmWGKKds',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman/create_salesman' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gfDq1M99PGkAV1EJ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman/activate_salesman' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::blTVQIuCa97tU6rp',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman/getAssignSalesmanCustomerList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SbOkrXBKJW3t880o',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman/getAssignSalesmanCustomerList/customer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::c0gY6dw7FN64eaX6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman/tagCustomertoSalesman' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::x6s61CcMuLXeymMm',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman/untagCustomertoSalesman' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wUbIoFc0hGojRhjq',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman/getSalesmanCustomerList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gJrCT4jTN3T7OlT3',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman/getSalesmanCustomerList/customer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iDd1gKbSOm0sVPgi',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman/getMaxCode' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IahTHtKalMcVYJsz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman/changePword' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9YqB4s2GC2TzjBQ1',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman/getMunicipality' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::W7xnuYkhSa29HiJX',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman/forPrint' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CAFDmGP8e3hHPC3k',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman/getAddress' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::x1CdYxUOT1aP48ZN',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/create_usertype' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gSeTXuRZ0I2X8VbS',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getUserTypes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8JcqUxqp2cBfSJJg',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman_route/getSalesman' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::B68fmbjOdex9ypow',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman_route/getTownList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::padvvCk9Q6b76Ke1',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman_route/postSchedule' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BLawq4Qg5ZV85KQL',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesman_route/print' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0i7Id2EwmzFC9gNs',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hepedeviaje/create_hepe' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::el6HD3Ix2PvhZCiZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hepedeviaje/get_hepe' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Eq8rPq1CMB1YNE8u',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hepedeviaje/get_hepe/name' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FHJIRDaqMzZ23UOW',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hepedeviaje/getAssignHepeSalesmanList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AMuBrhnCWNFGZYVi',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hepedeviaje/getAssignHepeSalesmanList/customer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DSRDFizxYuWujvjU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hepedeviaje/getHepeSalesmanList' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2G0aKSTmGTlCGc9U',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hepedeviaje/getHepeSalesmanList/customer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6p01mxmO4t6IHmv3',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hepedeviaje/tagSalesmanToHepe' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uixxSlf2aXpB9RoB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hepedeviaje/activate_hepe' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::O16FSXWZHGO1nNVC',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hepedeviaje/getSalesmanLogs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lazKpcu5mwVr66QP',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getCustomerRequests' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5t28clSl1yY7xuSD',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getCustomerRequests/customers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::89Kqj0UExjv0zOME',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getCustomerRequests/date' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WLugSN3ssLc3FSw9',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getApprovedCustomers/date' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sxCZaW3gujWVwvXR',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/approveCustomer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dq5RZ5U8IgbCY7gy',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getApprovedCustomers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mnkANXsqsW95KA8M',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getApprovedCustomers/customers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WbPz0uuSuhflbDeF',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rejectCustomer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gROOJtaGrCpdpR6D',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getRejectedCustomers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AKdCvbOBN4cVWr5Z',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getRejectedCustomers/customers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wrPt7YRUtFm6yPVu',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/importitemsbulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::J5nLMf0FSdu01Uyr',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getItemsBulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::48u2E0U8ukxK6QxX',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getItemsBulk/item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SwX1yk1eAp0RIzhd',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/importItemsFlowrack' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KeLEDeBoDQ89r5j3',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/importItemsBCOM' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZgzLti040BxJYJ8k',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getItemsBCOM' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2kO53J7F2JV5q0uL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getItemsBCOM/item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KiUPlXW1zdP5eCLx',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getItemsFlowrack' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qW0Hae6iG7FPoMwP',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getItemsFlowrack/item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::r8KSTvXy3jLxonvg',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/exportCustomerRequest' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YmvLpjp1SMGYsn1r',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/approvedBy' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rU2ssElrTQKMvw3L',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/principal/create_supplier' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lWQB8oweSRNWf4F6',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/principal/get_supplier' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OA8ob8zN9lFu0VNa',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/principal/get_supplier/name' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SWPfYbQ8EpHP4UbE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/principal/toggleSupplier' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XMlw90P35YEjCj8n',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/principal/get_supplier/dis' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::v4vhhAoLV2lBkL1A',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/principal/postDiscount' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZyHqiyZaCIHNxeZb',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/discount/getItems' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7wcxbLaScNe6Uffp',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/discount/getItems/name' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zmHDkqP8Tsug3B66',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/discount/getItems/withCategory' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::z8zikhnZAOI6ilaK',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/discount/postDiscount' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::gAlhVsBH4Qk90M6y',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesreport/getSalesman' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZHPfxWDjk3lYt1Xu',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesreport/getCustomer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NICeNEfMOQVMD3P4',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesreport/selectAll' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PCXqrVo2xaw35geM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesreport/customer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::n0GvFzBXE4DG0pgr',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesreport/ptype' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DbH6oiXHm77jh1jB',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesreport/ptypeAll' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xSzXeoe2Ujssq99J',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesreport/printReport' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Cs1cA9uMotgltPYi',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesreport/printReport2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FrTmufOudrMCRuJq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesreport/getJepe' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zXplA1zUoB1qhddw',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesreport/getJepeSales' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::I3KEoi1Y4HJX644P',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesreport/salesReportJepe/printSummary' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ePB79blAuiEUXhvW',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesreport/getOrderHistory' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::l6VE6fWCZkz5V39p',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/salesreport/printOrderHistory' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hgQGJtmsIoIdPft5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/topProducts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AN7Vi4HAHy7JDZgK',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/topProducts/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iNzFxTlONiDy2z8O',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/printTopProducts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qobFPz1YouFAWa5y',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/topCustomers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CRAJchlghYm0eJHd',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/topCustomers/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0GHnTjjIDPoFeCVf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/printTopCustomer' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9ZiUitPiQgKwpg5e',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/topSalesman' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rA35xk9hJ3R6zRoG',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/topSalesman/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KjBuZNTxaOoMvMvM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/printTopSalesman' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UB52jnLXigDEe0xI',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/topJepe' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Pc27RATXvYZSVmP1',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/topJepe/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dPg8RRXhxYJvkvQs',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/printTopJepe' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::k1XhiiTUhAP1wQQv',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/totalOrderCount' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8bJPDbyLibOYa2WH',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/printTotalOrderCount' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Z07pxaoiAzWajga2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/sourceOrderCount' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1Khmve5O82GvnVOz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/topReports/printsourceOrderCount' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nT9t7euO9HkzZYla',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/viewingUsers/getviewingUsers' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7dTza3WvRtbN4a9x',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/viewingUsers/toggleStatus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Wphylwco9GKKFLAN',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/viewingUsers/newViewingUser' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZETYpdg3vpBLRlPi',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/viewingUsers/getMaxCode' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UP4i3pIUz1O2g0M6',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/feedbacks/getResults' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::8BbfHfLpaQAMy4aQ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/getAuthUser' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Fu9yaJBFOvXJgys5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/import_masterfile/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'import_file',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/fixes/restore-lost-trans' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RnhBKLQF2xvNaye0',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/grouped-items-upload' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0XmOxb028S6OSgZv',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/password/reset/([^/]++)(*:31)|/messenger/retrieve/([^/]++)/([^/]++)(*:75)|/customer/person/([^/]++)(*:107)|/account_group_codes/delete_group_codes/([^/]++)(*:163)|/salesman_route/salesman/([^/]++)(*:204)|/(.*)(*:217))/?$}sDu',
    ),
    3 => 
    array (
      31 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      75 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hCHxAJE6GXxBmXqt',
          ),
          1 => 
          array (
            0 => 'contactCode',
            1 => 'contactRef',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      107 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HL3RuXI8Mbd4OXAR',
          ),
          1 => 
          array (
            0 => 'customer_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      163 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VEqpAwm3RGqKlEh2',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      204 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BcPBlNalxaG5E5Z5',
          ),
          1 => 
          array (
            0 => 'salesman_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      217 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::46WNx5L8vFMxwArL',
          ),
          1 => 
          array (
            0 => 'any',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'generated::Ffho1uAZHkBK7wbx' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::Ffho1uAZHkBK7wbx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'layouts.app',
        'data' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::9T4ETqzFSSElk45Q' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::9T4ETqzFSSElk45Q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::RaTLWXhzoyVznpOQ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::RaTLWXhzoyVznpOQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.email',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Ivil0uBgawqajwal' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::Ivil0uBgawqajwal',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::inTnx3t9qyuOnSM3' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user/add_new_user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@store',
        'controller' => 'App\\Http\\Controllers\\HomeController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::inTnx3t9qyuOnSM3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::8yuhtlMzz8yR26MI' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/getUser',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@getAllUsers',
        'controller' => 'App\\Http\\Controllers\\HomeController@getAllUsers',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::8yuhtlMzz8yR26MI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::i0AOZbVQefFlUpA9' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/getUser/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@searchUser',
        'controller' => 'App\\Http\\Controllers\\HomeController@searchUser',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::i0AOZbVQefFlUpA9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::piEYuRSA2NooFfAy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/getUserAcct',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@getAllUsersAcct',
        'controller' => 'App\\Http\\Controllers\\HomeController@getAllUsersAcct',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::piEYuRSA2NooFfAy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::yzPS5x6kzjsz3EJ4' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/getUserAcct/usersAcct',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@searchUserAcct',
        'controller' => 'App\\Http\\Controllers\\HomeController@searchUserAcct',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::yzPS5x6kzjsz3EJ4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::lN4nDrdZXWi9z0Wi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/getAdmin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@getAdmins',
        'controller' => 'App\\Http\\Controllers\\HomeController@getAdmins',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::lN4nDrdZXWi9z0Wi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::16TURyEUsFvGdskW' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/getAdmin/admin',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@searchAdmin',
        'controller' => 'App\\Http\\Controllers\\HomeController@searchAdmin',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::16TURyEUsFvGdskW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ephPQkwJJ3QnTrgF' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/getHepedeViaje',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@getHepedeViaje',
        'controller' => 'App\\Http\\Controllers\\HomeController@getHepedeViaje',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::ephPQkwJJ3QnTrgF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::dA0NyB7pbjH34xsf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/getHepedeViaje/hepedeviaje',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@searchHepedeViaje',
        'controller' => 'App\\Http\\Controllers\\HomeController@searchHepedeViaje',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::dA0NyB7pbjH34xsf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::w8SwfucS2u4DMkgU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/getSalesman',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@getSalesmans',
        'controller' => 'App\\Http\\Controllers\\HomeController@getSalesmans',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::w8SwfucS2u4DMkgU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::bzMEJyMw3Btz7rp1' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/getSalesman/salesman',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@searchSalesman',
        'controller' => 'App\\Http\\Controllers\\HomeController@searchSalesman',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::bzMEJyMw3Btz7rp1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::tvBIQb7vObjN9W2r' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/getCustomer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@getCustomers',
        'controller' => 'App\\Http\\Controllers\\HomeController@getCustomers',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::tvBIQb7vObjN9W2r',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::DEdtIBO1nMUhqT2P' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/getCustomer/customer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@searchCustomer',
        'controller' => 'App\\Http\\Controllers\\HomeController@searchCustomer',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::DEdtIBO1nMUhqT2P',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::KOjiJtbzxNEYios2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/get_month',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@getMonth',
        'controller' => 'App\\Http\\Controllers\\HomeController@getMonth',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::KOjiJtbzxNEYios2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::tvVNoNAqNMexRkVe' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user/get_year',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@getYear',
        'controller' => 'App\\Http\\Controllers\\HomeController@getYear',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/user',
        'where' => 
        array (
        ),
        'as' => 'generated::tvVNoNAqNMexRkVe',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::eOxTs70fFHShtxTK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'consolidated/getConsolidated',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ConsolidatedTransactionController@getConsolidated',
        'controller' => 'App\\Http\\Controllers\\ConsolidatedTransactionController@getConsolidated',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/consolidated',
        'where' => 
        array (
        ),
        'as' => 'generated::eOxTs70fFHShtxTK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::uR1aOXp8GBKEdoXD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'consolidated/getConsolidated/consolidated',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ConsolidatedTransactionController@searchConsolidated',
        'controller' => 'App\\Http\\Controllers\\ConsolidatedTransactionController@searchConsolidated',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/consolidated',
        'where' => 
        array (
        ),
        'as' => 'generated::uR1aOXp8GBKEdoXD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::VeR8ovXihB7kdZun' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'consolidated/generate_si_test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ConsolidatedTransactionController@generateSITest',
        'controller' => 'App\\Http\\Controllers\\ConsolidatedTransactionController@generateSITest',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/consolidated',
        'where' => 
        array (
        ),
        'as' => 'generated::VeR8ovXihB7kdZun',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Gov0K4ucL0qubTx1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'item/saved_item_image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@store_image',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@store_image',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::Gov0K4ucL0qubTx1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::oXkU1F0ogIX620C7' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getItem',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@getListItems',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@getListItems',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::oXkU1F0ogIX620C7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::jVjP5OLyLpYgkMXR' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getItem/item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@searchItem',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@searchItem',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::jVjP5OLyLpYgkMXR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::onK8RXkZWAqIXPVt' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/activate_item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@activate',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@activate',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::onK8RXkZWAqIXPVt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::i5nEbLbzfG2foBh0' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'item/saved_item_image1',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@store_image',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@store_image',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::i5nEbLbzfG2foBh0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::tts2jSdfQmtnJjF7' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getItem1',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@getListItems1',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@getListItems1',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::tts2jSdfQmtnJjF7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ePR2q3YUZJrEaAlZ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getItem1/item1',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@searchItem1',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@searchItem1',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::ePR2q3YUZJrEaAlZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::YQrHbsHs1meAo5Qa' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/activate_item1',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@activate',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@activate',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::YQrHbsHs1meAo5Qa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::FODCsHwoUqA4VHWk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getItem2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@getListItems2',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@getListItems2',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::FODCsHwoUqA4VHWk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::HMRP4ey7cBzCrIYk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getItem2/item2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@searchItemu',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@searchItemu',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::HMRP4ey7cBzCrIYk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::DmX6gR3ScjUnSi71' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/activate_item2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@activate',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@activate',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::DmX6gR3ScjUnSi71',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::W227wThDsNURVzGF' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getNoItem',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@getListNoItems',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@getListNoItems',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::W227wThDsNURVzGF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::3sZSw5uyvVtUWo8H' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getNoItem/noitem',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@searchNoItem',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@searchNoItem',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::3sZSw5uyvVtUWo8H',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::iA5UnHdNqPfYTRDA' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/drop_noitem',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@dropItem',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@dropItem',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::iA5UnHdNqPfYTRDA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::UD4akrYUD7Tl7vND' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getReturnedItems',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@getReturnedItems',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@getReturnedItems',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::UD4akrYUD7Tl7vND',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::iDdHCPNB9AtVx7am' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getReturnedItems1',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@print',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@print',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::iDdHCPNB9AtVx7am',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::DlxeuGnnHvyNf7hj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getReturnedItems2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@transaction',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@transaction',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::DlxeuGnnHvyNf7hj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::fKW7s1H1ryXyo7m3' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getReturnedItems/item_returned',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@searchReturnedItems',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@searchReturnedItems',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::fKW7s1H1ryXyo7m3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Kky3RPEU0y6GV3S3' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getUnservedItems',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@getReturnedItemsnaUnserved',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@getReturnedItemsnaUnserved',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::Kky3RPEU0y6GV3S3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::9A2HT1BSnmesmSU9' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getUnservedItems/item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@searchUnservedItems',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@searchUnservedItems',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::9A2HT1BSnmesmSU9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ETjZKVoMFiUyknsF' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getUnservedItems/print',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@printUnserved',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@printUnserved',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::ETjZKVoMFiUyknsF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ieycdtfNBfErH4k0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getItemLog',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemHistoryLogController@getListItemsLog',
        'controller' => 'App\\Http\\Controllers\\ItemHistoryLogController@getListItemsLog',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::ieycdtfNBfErH4k0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::FYfMmgVJW259L1s6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getItemLog/item_log',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemHistoryLogController@searchItemLog',
        'controller' => 'App\\Http\\Controllers\\ItemHistoryLogController@searchItemLog',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::FYfMmgVJW259L1s6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::2VtbO0jcQC5gcSFd' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getItemDetailsLog/itemlogdetail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemHistoryLogController@detailsLog',
        'controller' => 'App\\Http\\Controllers\\ItemHistoryLogController@detailsLog',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::2VtbO0jcQC5gcSFd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::QbObKX34aIjxOxdU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getOrderItem',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@getCategoryItem',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@getCategoryItem',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::QbObKX34aIjxOxdU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::nQeADpaQpeNh6pYE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'item/getOrderItem/item3',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@searchCategoryItem',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@searchCategoryItem',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/item',
        'where' => 
        array (
        ),
        'as' => 'generated::nQeADpaQpeNh6pYE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::rcEO2nW72VpbaqOR' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'messenger',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\MessengerController@index',
        'controller' => 'App\\Http\\Controllers\\MessengerController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/messenger',
        'where' => 
        array (
        ),
        'as' => 'generated::rcEO2nW72VpbaqOR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::hCHxAJE6GXxBmXqt' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'messenger/retrieve/{contactCode}/{contactRef}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\MessengerController@retrieveMessages',
        'controller' => 'App\\Http\\Controllers\\MessengerController@retrieveMessages',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/messenger',
        'where' => 
        array (
        ),
        'as' => 'generated::hCHxAJE6GXxBmXqt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ins95xNupW4amEKi' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'messenger',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\MessengerController@sendMessage',
        'controller' => 'App\\Http\\Controllers\\MessengerController@sendMessage',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/messenger',
        'where' => 
        array (
        ),
        'as' => 'generated::ins95xNupW4amEKi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::33xpFUll8EHxjXKC' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'messenger/deactivate_chat',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\MessengerController@deactivateChat',
        'controller' => 'App\\Http\\Controllers\\MessengerController@deactivateChat',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/messenger',
        'where' => 
        array (
        ),
        'as' => 'generated::33xpFUll8EHxjXKC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Czx0RSBLhBQjLnlN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'messenger/create_new_chat',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\MessengerController@createNewChat',
        'controller' => 'App\\Http\\Controllers\\MessengerController@createNewChat',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/messenger',
        'where' => 
        array (
        ),
        'as' => 'generated::Czx0RSBLhBQjLnlN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::RE5KZ8CPXCCStFyy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tele_ordering/get_categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesOrderController@getCategories',
        'controller' => 'App\\Http\\Controllers\\SalesOrderController@getCategories',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/tele_ordering',
        'where' => 
        array (
        ),
        'as' => 'generated::RE5KZ8CPXCCStFyy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::NawqApsHu9aIs8Gj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tele_ordering/get_customers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesOrderController@getCustomers',
        'controller' => 'App\\Http\\Controllers\\SalesOrderController@getCustomers',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/tele_ordering',
        'where' => 
        array (
        ),
        'as' => 'generated::NawqApsHu9aIs8Gj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::DINm8UAqQNpw6Z4w' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tele_ordering/getTransaction',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesOrderController@getAddTransaction',
        'controller' => 'App\\Http\\Controllers\\SalesOrderController@getAddTransaction',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/tele_ordering',
        'where' => 
        array (
        ),
        'as' => 'generated::DINm8UAqQNpw6Z4w',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::xCewXGAzx09e9dJE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tele_ordering/getTransaction/addtrans',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesOrderController@searchAddTrans',
        'controller' => 'App\\Http\\Controllers\\SalesOrderController@searchAddTrans',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/tele_ordering',
        'where' => 
        array (
        ),
        'as' => 'generated::xCewXGAzx09e9dJE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::VtMdYHYegvmOHsEQ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'tele_ordering/additionalOrder',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesOrderController@store',
        'controller' => 'App\\Http\\Controllers\\SalesOrderController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/tele_ordering',
        'where' => 
        array (
        ),
        'as' => 'generated::VtMdYHYegvmOHsEQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Y1h8duaBZSUeNzp0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tele_ordering/cancelOrder',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesOrderController@cancelOrder',
        'controller' => 'App\\Http\\Controllers\\SalesOrderController@cancelOrder',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/tele_ordering',
        'where' => 
        array (
        ),
        'as' => 'generated::Y1h8duaBZSUeNzp0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::7TOaCuJr8YXpB3pu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tele_ordering/getCustomerInfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesOrderController@getCustomerInfo',
        'controller' => 'App\\Http\\Controllers\\SalesOrderController@getCustomerInfo',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/tele_ordering',
        'where' => 
        array (
        ),
        'as' => 'generated::7TOaCuJr8YXpB3pu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::MIYFt6si3EgZravp' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cut_off_time/set_time_cutoff',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@setCutoffTime',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@setCutoffTime',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/cut_off_time',
        'where' => 
        array (
        ),
        'as' => 'generated::MIYFt6si3EgZravp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::lDX4JsgIwlpt2Blj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cut_off_time/get_time_setup',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@getTimeSetup',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@getTimeSetup',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/cut_off_time',
        'where' => 
        array (
        ),
        'as' => 'generated::lDX4JsgIwlpt2Blj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::BprhiJZo3AyamY8L' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTransaction',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTransaction',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::BprhiJZo3AyamY8L',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::l5YDBXbeHLe3mj9Y' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction1',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTransaction1',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTransaction1',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::l5YDBXbeHLe3mj9Y',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::kBgcrW4pbDBYbfoO' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTransaction2',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTransaction2',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::kBgcrW4pbDBYbfoO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::755IIJqEu5GQ5aYz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction3',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTransaction3',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTransaction3',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::755IIJqEu5GQ5aYz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::OhT9coPHmRfV0ZUw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction4',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTransaction4',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTransaction4',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::OhT9coPHmRfV0ZUw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::U3Ltg6XlyVbW59RR' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction5',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTransaction5',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTransaction5',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::U3Ltg6XlyVbW59RR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::RADuyLIN63KSFzPB' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction6',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTransaction6',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTransaction6',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::RADuyLIN63KSFzPB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::lOU3LsZaZXNSWwuQ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction7',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTransaction7',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTransaction7',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::lOU3LsZaZXNSWwuQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ZF3AKQWc4xfo5CyE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction/transaction',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@searchTransaction',
        'controller' => 'App\\Http\\Controllers\\TransactionController@searchTransaction',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::ZF3AKQWc4xfo5CyE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::jDbaGi9ubHKF8z6h' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction/transaction1',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@searchTransaction1',
        'controller' => 'App\\Http\\Controllers\\TransactionController@searchTransaction1',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::jDbaGi9ubHKF8z6h',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::QNUeonp8ky0C79sA' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction/transaction2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@searchTransaction2',
        'controller' => 'App\\Http\\Controllers\\TransactionController@searchTransaction2',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::QNUeonp8ky0C79sA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::FTtvsW1ABuRky1kR' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction/transaction3',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@searchTransaction3',
        'controller' => 'App\\Http\\Controllers\\TransactionController@searchTransaction3',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::FTtvsW1ABuRky1kR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::sZyJ4ISZZ1cYzK3i' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction/transaction4',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@searchTransaction4',
        'controller' => 'App\\Http\\Controllers\\TransactionController@searchTransaction4',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::sZyJ4ISZZ1cYzK3i',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::vgOwOAoKOYccwOZj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction/transaction5',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@searchTransaction5',
        'controller' => 'App\\Http\\Controllers\\TransactionController@searchTransaction5',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::vgOwOAoKOYccwOZj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Lt7bRZOcNOOZgD9K' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction/transaction6',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@searchTransaction6',
        'controller' => 'App\\Http\\Controllers\\TransactionController@searchTransaction6',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::Lt7bRZOcNOOZgD9K',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::eAvXtoZeXmPNdSrV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTransaction/transaction7',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@searchTransaction7',
        'controller' => 'App\\Http\\Controllers\\TransactionController@searchTransaction7',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::eAvXtoZeXmPNdSrV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::YeNDEs5GzzOASgq3' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getOrderTransaction/order_detail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getOrderDetails',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getOrderDetails',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::YeNDEs5GzzOASgq3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::RYtLFD5CX3nsvsDG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getOrderTransaction/teleorder_detail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTeleOrderDetails',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTeleOrderDetails',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::RYtLFD5CX3nsvsDG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::nOZeDkn6SLeEcMe3' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getOrder',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getOrder',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getOrder',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::nOZeDkn6SLeEcMe3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::jLKwlioqJ2ywBil2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getOrder/order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@searchOrder',
        'controller' => 'App\\Http\\Controllers\\TransactionController@searchOrder',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::jLKwlioqJ2ywBil2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::HYmdD6xUTqlOdMBz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getOrderTransaction1/order_detail1',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getOrder1',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getOrder1',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::HYmdD6xUTqlOdMBz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::WsCyMJ2FaNIxmRJE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTotalAmount',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTotalAmount',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTotalAmount',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::WsCyMJ2FaNIxmRJE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::BWFk9TnKEvSGk9xJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTotalAmountDel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountDel',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountDel',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::BWFk9TnKEvSGk9xJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::HspHugXnBny4lSVu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTotalAmountRet',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountRet',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountRet',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::HspHugXnBny4lSVu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::x70TExQdoPGSziN6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTotalAmountCanc',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountCanc',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountCanc',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::x70TExQdoPGSziN6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::joJmvI2A8mu0lC3K' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTotalAmountAdv',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountAdv',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountAdv',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::joJmvI2A8mu0lC3K',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::xe9F0H0gWZPzbtIj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTotalAll',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountAll',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountAll',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::xe9F0H0gWZPzbtIj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Ci21Bwxl47uR3pcZ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTotalSubmitted',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountSubmitted',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountSubmitted',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::Ci21Bwxl47uR3pcZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::f4tHiRE9ru3n3aRt' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTotalOnProcess',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountOnProcess',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountOnProcess',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::f4tHiRE9ru3n3aRt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::6lc3SVAjCoR7PLk5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTotalApproved',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountApproved',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountApproved',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::6lc3SVAjCoR7PLk5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::rUwbnWvdha9FcPCE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTotalDelivered',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountDelivered',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountDelivered',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::rUwbnWvdha9FcPCE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::6frpkHg9nu1R8paa' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTotalReturned',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountReturned',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountReturned',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::6frpkHg9nu1R8paa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::JOODnMiolfxAocPb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTotalCancelled',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountCancelled',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountCancelled',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::JOODnMiolfxAocPb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::VoYsuUoNY0Tk4Mcg' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/getTotalAdvanced',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountAdvanced',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getTotalAmountAdvanced',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::VoYsuUoNY0Tk4Mcg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::QnRj4ojTjbYz1HQK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/get-ongoing-transactions-count',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@getOngoingTransactionsCount',
        'controller' => 'App\\Http\\Controllers\\TransactionController@getOngoingTransactionsCount',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::QnRj4ojTjbYz1HQK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::gK7ipsRyWHV7IDKr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'transaction/advanced-orders-count',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@advancedOrdersCount',
        'controller' => 'App\\Http\\Controllers\\TransactionController@advancedOrdersCount',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::gK7ipsRyWHV7IDKr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::3hRmglhfGUIy7IIX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'transaction/revert-transaction',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@revertTransaction',
        'controller' => 'App\\Http\\Controllers\\TransactionController@revertTransaction',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::3hRmglhfGUIy7IIX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::RqqeENWRiyCPUfSS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'transaction/delete-transaction',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TransactionController@deleteTransaction',
        'controller' => 'App\\Http\\Controllers\\TransactionController@deleteTransaction',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/transaction',
        'where' => 
        array (
        ),
        'as' => 'generated::RqqeENWRiyCPUfSS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::CT1CuMpGrK7S1dDq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/getExportBcom',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@getBcom',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@getBcom',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::CT1CuMpGrK7S1dDq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::vbJh5wLd6EnxENxY' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/getExportBcom/bcom',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@searchBcom',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@searchBcom',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::vbJh5wLd6EnxENxY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::TLfHocxFvB1Gtc1s' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/getExportAris',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@getAris',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@getAris',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::TLfHocxFvB1Gtc1s',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::E7U1sSn6HRs243Wj' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/getExportAris/aris',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@searchAris',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@searchAris',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::E7U1sSn6HRs243Wj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::3B2Pi8v78Q3YVOHX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/get_export_files_bcom',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@export',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@export',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::3B2Pi8v78Q3YVOHX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::1Ly8pvnrG6PaW1Ae' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/get_export_files_bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@export2',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@export2',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::1Ly8pvnrG6PaW1Ae',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Gv18ue853zWNuQsi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/get_export_files_flowrack',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@transaction',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@transaction',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::Gv18ue853zWNuQsi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::N3RyzSDFDx8vl8vJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/get_export_files_bcom_unserved',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@export_unserved_bcom',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@export_unserved_bcom',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::N3RyzSDFDx8vl8vJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::WuclGFkqXWNHdfkJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/get_export_files_bulk_unserved',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@export_unserved_bulk',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@export_unserved_bulk',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::WuclGFkqXWNHdfkJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::wZ74AnmTCkg2QYBx' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/get_export_files_flowrack_unserved',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@transaction_unserved_flowrack',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@transaction_unserved_flowrack',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::wZ74AnmTCkg2QYBx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::186OG65bq571nVV2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/get_export_files_aris',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@export_aris',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@export_aris',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::186OG65bq571nVV2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::neZk6EEtDpxBQdYv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/getExportBulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@getBulk',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@getBulk',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::neZk6EEtDpxBQdYv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::lEPUfJ6Ln37fS9YS' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/getOrder/bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@searchBulk',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@searchBulk',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::lEPUfJ6Ln37fS9YS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::r5CI0OGa74qeNgls' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/getExportUnserved',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@getUnserved',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@getUnserved',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::r5CI0OGa74qeNgls',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::xvTN5stpTcot80na' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'export/getExportUnserved/unserved',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesExportFilesController@searchUnserved',
        'controller' => 'App\\Http\\Controllers\\SalesExportFilesController@searchUnserved',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/export',
        'where' => 
        array (
        ),
        'as' => 'generated::xvTN5stpTcot80na',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::CpAdYbFPZzkGRZ94' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'import_masterfile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@item_masterfile_import',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@item_masterfile_import',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::CpAdYbFPZzkGRZ94',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ebmPSO6u5VX0qHTg' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'import_csv_masterfile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@item_csv_masterfile_import',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@item_csv_masterfile_import',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::ebmPSO6u5VX0qHTg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::1E9cxudA6ejP5srz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'import_consolidated_masterfile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ConsolidatedTransactionController@consolidated_masterfile_import',
        'controller' => 'App\\Http\\Controllers\\ConsolidatedTransactionController@consolidated_masterfile_import',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::1E9cxudA6ejP5srz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::73RpSkxtfQqdZ9Ki' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get_updated_list_item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@getListUpdatedItem',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@getListUpdatedItem',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::73RpSkxtfQqdZ9Ki',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::WgmhyzAieskX56of' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get_unupdatedlist_item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@getListUnUpdatedItem',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@getListUnUpdatedItem',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::WgmhyzAieskX56of',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::mNFNgi6XJhDfGrxb' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/create_customeraccnt',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@store',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::mNFNgi6XJhDfGrxb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::RXv5hf9pZQEj62ZN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/activate_customer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@activate',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@activate',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::RXv5hf9pZQEj62ZN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ezncZFITJ1icTjJI' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/api/persons/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@get',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@get',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::ezncZFITJ1icTjJI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::HL3RuXI8Mbd4OXAR' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/person/{customer_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@getCustomer',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@getCustomer',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::HL3RuXI8Mbd4OXAR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::3NMko2JdyZKtOJMh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/get_account_details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@get_account_details',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@get_account_details',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::3NMko2JdyZKtOJMh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::FdArx10LAJ874zio' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/getCustomers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@getCustomers',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@getCustomers',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::FdArx10LAJ874zio',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::rkw2vm3sMlUeoINh' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/getCustomers2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@getCustomers2',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@getCustomers2',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::rkw2vm3sMlUeoINh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ijn7tfludaSySeoI' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/getCustomers2/customer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@searchCustomer',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@searchCustomer',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::ijn7tfludaSySeoI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::WajEJt6zXkq71ZSJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/update_customeraccnt',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@updateCustomer',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@updateCustomer',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::WajEJt6zXkq71ZSJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'customer_import' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/import/customer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@importCust',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@importCust',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'customer_import',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::n2U1hRIbCofzTQbO' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/getSalesmanCode',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@show',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::n2U1hRIbCofzTQbO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Te9rzjH2Oy4JXltz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/getSalesmanDetails',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@getSalesmanDetails',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@getSalesmanDetails',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::Te9rzjH2Oy4JXltz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::zAeZhEyn1Iu2zubn' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/postCredit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@postCredit',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@postCredit',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::zAeZhEyn1Iu2zubn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::8ElFwhLvvvXVRlUB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/setDefaultPassword',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@setDefaultPassword',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@setDefaultPassword',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::8ElFwhLvvvXVRlUB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::0vYfHkumoCnyNmRO' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/get_principal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@get_principal',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@get_principal',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::0vYfHkumoCnyNmRO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::P2k2N3QUIzrwDjxe' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/get_principal/name',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@searchSupplier',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@searchSupplier',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::P2k2N3QUIzrwDjxe',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::n1IUL2mMzrhbY7Zl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/postDiscount',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@postDiscount',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@postDiscount',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::n1IUL2mMzrhbY7Zl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::aRqY9mfVEpYXIjVR' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/getPList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@getPList',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@getPList',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::aRqY9mfVEpYXIjVR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::KXvfltTviMMTtoUo' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/getPList/name',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@searchPList',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@searchPList',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::KXvfltTviMMTtoUo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::OYYGlACoUjWoLzMx' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer/tagPList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@tagPList',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@tagPList',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::OYYGlACoUjWoLzMx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::EGqZ35iLe2l6n95L' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'customer/forPrint',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerMasterFileController@forPrint',
        'controller' => 'App\\Http\\Controllers\\CustomerMasterFileController@forPrint',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/customer',
        'where' => 
        array (
        ),
        'as' => 'generated::EGqZ35iLe2l6n95L',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::wsNDAXvmIVFAfB7W' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'account_group_codes/create_group_code',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountGroupCodeController@store',
        'controller' => 'App\\Http\\Controllers\\AccountGroupCodeController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/account_group_codes',
        'where' => 
        array (
        ),
        'as' => 'generated::wsNDAXvmIVFAfB7W',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::xuBNjTftGNeJAb1N' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'account_group_codes/get_account_group_codes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountGroupCodeController@getGroupCodes',
        'controller' => 'App\\Http\\Controllers\\AccountGroupCodeController@getGroupCodes',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/account_group_codes',
        'where' => 
        array (
        ),
        'as' => 'generated::xuBNjTftGNeJAb1N',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::VEqpAwm3RGqKlEh2' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'account_group_codes/delete_group_codes/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\AccountGroupCodeController@destroy',
        'controller' => 'App\\Http\\Controllers\\AccountGroupCodeController@destroy',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/account_group_codes',
        'where' => 
        array (
        ),
        'as' => 'generated::VEqpAwm3RGqKlEh2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::TBHTqcZwCmWGKKds' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesman/get_salesman_list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanListController@getSalesman',
        'controller' => 'App\\Http\\Controllers\\SalesmanListController@getSalesman',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman',
        'where' => 
        array (
        ),
        'as' => 'generated::TBHTqcZwCmWGKKds',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::gfDq1M99PGkAV1EJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'salesman/create_salesman',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanListController@create',
        'controller' => 'App\\Http\\Controllers\\SalesmanListController@create',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman',
        'where' => 
        array (
        ),
        'as' => 'generated::gfDq1M99PGkAV1EJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::blTVQIuCa97tU6rp' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'salesman/activate_salesman',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanListController@activate',
        'controller' => 'App\\Http\\Controllers\\SalesmanListController@activate',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman',
        'where' => 
        array (
        ),
        'as' => 'generated::blTVQIuCa97tU6rp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::SbOkrXBKJW3t880o' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesman/getAssignSalesmanCustomerList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanListController@getAssignSalesmanCustomerList',
        'controller' => 'App\\Http\\Controllers\\SalesmanListController@getAssignSalesmanCustomerList',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman',
        'where' => 
        array (
        ),
        'as' => 'generated::SbOkrXBKJW3t880o',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::c0gY6dw7FN64eaX6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesman/getAssignSalesmanCustomerList/customer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanListController@searchAssignSalesmanCustomerList',
        'controller' => 'App\\Http\\Controllers\\SalesmanListController@searchAssignSalesmanCustomerList',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman',
        'where' => 
        array (
        ),
        'as' => 'generated::c0gY6dw7FN64eaX6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::x6s61CcMuLXeymMm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'salesman/tagCustomertoSalesman',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanListController@tagCustomertoSalesman',
        'controller' => 'App\\Http\\Controllers\\SalesmanListController@tagCustomertoSalesman',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman',
        'where' => 
        array (
        ),
        'as' => 'generated::x6s61CcMuLXeymMm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::wUbIoFc0hGojRhjq' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'salesman/untagCustomertoSalesman',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanListController@untagCustomertoSalesman',
        'controller' => 'App\\Http\\Controllers\\SalesmanListController@untagCustomertoSalesman',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman',
        'where' => 
        array (
        ),
        'as' => 'generated::wUbIoFc0hGojRhjq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::gJrCT4jTN3T7OlT3' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesman/getSalesmanCustomerList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanListController@getSalesmanCustomerList',
        'controller' => 'App\\Http\\Controllers\\SalesmanListController@getSalesmanCustomerList',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman',
        'where' => 
        array (
        ),
        'as' => 'generated::gJrCT4jTN3T7OlT3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::iDd1gKbSOm0sVPgi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesman/getSalesmanCustomerList/customer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanListController@searchSalesmanCustomerList',
        'controller' => 'App\\Http\\Controllers\\SalesmanListController@searchSalesmanCustomerList',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman',
        'where' => 
        array (
        ),
        'as' => 'generated::iDd1gKbSOm0sVPgi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::IahTHtKalMcVYJsz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'salesman/getMaxCode',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanListController@getMaxCode',
        'controller' => 'App\\Http\\Controllers\\SalesmanListController@getMaxCode',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman',
        'where' => 
        array (
        ),
        'as' => 'generated::IahTHtKalMcVYJsz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::9YqB4s2GC2TzjBQ1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'salesman/changePword',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanListController@changePword',
        'controller' => 'App\\Http\\Controllers\\SalesmanListController@changePword',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman',
        'where' => 
        array (
        ),
        'as' => 'generated::9YqB4s2GC2TzjBQ1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::W7xnuYkhSa29HiJX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesman/getMunicipality',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanListController@getMunicipality',
        'controller' => 'App\\Http\\Controllers\\SalesmanListController@getMunicipality',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman',
        'where' => 
        array (
        ),
        'as' => 'generated::W7xnuYkhSa29HiJX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::CAFDmGP8e3hHPC3k' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesman/forPrint',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanListController@forPrint',
        'controller' => 'App\\Http\\Controllers\\SalesmanListController@forPrint',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman',
        'where' => 
        array (
        ),
        'as' => 'generated::CAFDmGP8e3hHPC3k',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::x1CdYxUOT1aP48ZN' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesman/getAddress',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanListController@getAddress',
        'controller' => 'App\\Http\\Controllers\\SalesmanListController@getAddress',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman',
        'where' => 
        array (
        ),
        'as' => 'generated::x1CdYxUOT1aP48ZN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::gSeTXuRZ0I2X8VbS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'create_usertype',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TblUsertypeController@store',
        'controller' => 'App\\Http\\Controllers\\TblUsertypeController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::gSeTXuRZ0I2X8VbS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::8JcqUxqp2cBfSJJg' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getUserTypes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TblUserTypeController@index',
        'controller' => 'App\\Http\\Controllers\\TblUserTypeController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::8JcqUxqp2cBfSJJg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::B68fmbjOdex9ypow' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesman_route/getSalesman',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanRouteController@getSalesman',
        'controller' => 'App\\Http\\Controllers\\SalesmanRouteController@getSalesman',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman_route',
        'where' => 
        array (
        ),
        'as' => 'generated::B68fmbjOdex9ypow',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::padvvCk9Q6b76Ke1' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesman_route/getTownList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanRouteController@getTownList',
        'controller' => 'App\\Http\\Controllers\\SalesmanRouteController@getTownList',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman_route',
        'where' => 
        array (
        ),
        'as' => 'generated::padvvCk9Q6b76Ke1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::BcPBlNalxaG5E5Z5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesman_route/salesman/{salesman_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanRouteController@getSalesmanRoutes',
        'controller' => 'App\\Http\\Controllers\\SalesmanRouteController@getSalesmanRoutes',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman_route',
        'where' => 
        array (
        ),
        'as' => 'generated::BcPBlNalxaG5E5Z5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::BLawq4Qg5ZV85KQL' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'salesman_route/postSchedule',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanRouteController@postSchedule',
        'controller' => 'App\\Http\\Controllers\\SalesmanRouteController@postSchedule',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman_route',
        'where' => 
        array (
        ),
        'as' => 'generated::BLawq4Qg5ZV85KQL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::0i7Id2EwmzFC9gNs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesman_route/print',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesmanRouteController@print',
        'controller' => 'App\\Http\\Controllers\\SalesmanRouteController@print',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesman_route',
        'where' => 
        array (
        ),
        'as' => 'generated::0i7Id2EwmzFC9gNs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::el6HD3Ix2PvhZCiZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hepedeviaje/create_hepe',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HepeDeViajeController@create_hepe',
        'controller' => 'App\\Http\\Controllers\\HepeDeViajeController@create_hepe',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/hepedeviaje',
        'where' => 
        array (
        ),
        'as' => 'generated::el6HD3Ix2PvhZCiZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Eq8rPq1CMB1YNE8u' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hepedeviaje/get_hepe',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HepeDeViajeController@get_hepe',
        'controller' => 'App\\Http\\Controllers\\HepeDeViajeController@get_hepe',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/hepedeviaje',
        'where' => 
        array (
        ),
        'as' => 'generated::Eq8rPq1CMB1YNE8u',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::FHJIRDaqMzZ23UOW' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hepedeviaje/get_hepe/name',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HepeDeViajeController@search_hepe',
        'controller' => 'App\\Http\\Controllers\\HepeDeViajeController@search_hepe',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/hepedeviaje',
        'where' => 
        array (
        ),
        'as' => 'generated::FHJIRDaqMzZ23UOW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::AMuBrhnCWNFGZYVi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hepedeviaje/getAssignHepeSalesmanList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HepeDeViajeController@getAssignHepeSalesmanList',
        'controller' => 'App\\Http\\Controllers\\HepeDeViajeController@getAssignHepeSalesmanList',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/hepedeviaje',
        'where' => 
        array (
        ),
        'as' => 'generated::AMuBrhnCWNFGZYVi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::DSRDFizxYuWujvjU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hepedeviaje/getAssignHepeSalesmanList/customer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HepeDeViajeController@searchAssignSalesmanCustomerList',
        'controller' => 'App\\Http\\Controllers\\HepeDeViajeController@searchAssignSalesmanCustomerList',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/hepedeviaje',
        'where' => 
        array (
        ),
        'as' => 'generated::DSRDFizxYuWujvjU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::2G0aKSTmGTlCGc9U' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hepedeviaje/getHepeSalesmanList',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HepeDeViajeController@getHepeSalesmanList',
        'controller' => 'App\\Http\\Controllers\\HepeDeViajeController@getHepeSalesmanList',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/hepedeviaje',
        'where' => 
        array (
        ),
        'as' => 'generated::2G0aKSTmGTlCGc9U',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::6p01mxmO4t6IHmv3' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hepedeviaje/getHepeSalesmanList/customer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HepeDeViajeController@searchHepeSalesmanList',
        'controller' => 'App\\Http\\Controllers\\HepeDeViajeController@searchHepeSalesmanList',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/hepedeviaje',
        'where' => 
        array (
        ),
        'as' => 'generated::6p01mxmO4t6IHmv3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::uixxSlf2aXpB9RoB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hepedeviaje/tagSalesmanToHepe',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HepeDeViajeController@tagSalesmanToHepe',
        'controller' => 'App\\Http\\Controllers\\HepeDeViajeController@tagSalesmanToHepe',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/hepedeviaje',
        'where' => 
        array (
        ),
        'as' => 'generated::uixxSlf2aXpB9RoB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::O16FSXWZHGO1nNVC' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hepedeviaje/activate_hepe',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HepeDeViajeController@activate_hepe',
        'controller' => 'App\\Http\\Controllers\\HepeDeViajeController@activate_hepe',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/hepedeviaje',
        'where' => 
        array (
        ),
        'as' => 'generated::O16FSXWZHGO1nNVC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::lazKpcu5mwVr66QP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hepedeviaje/getSalesmanLogs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HepeDeViajeController@getSalesmanLogs',
        'controller' => 'App\\Http\\Controllers\\HepeDeViajeController@getSalesmanLogs',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/hepedeviaje',
        'where' => 
        array (
        ),
        'as' => 'generated::lazKpcu5mwVr66QP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::5t28clSl1yY7xuSD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getCustomerRequests',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerRequestController@getCustomerRequests',
        'controller' => 'App\\Http\\Controllers\\CustomerRequestController@getCustomerRequests',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::5t28clSl1yY7xuSD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::89Kqj0UExjv0zOME' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getCustomerRequests/customers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerRequestController@searchCustomerRequests',
        'controller' => 'App\\Http\\Controllers\\CustomerRequestController@searchCustomerRequests',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::89Kqj0UExjv0zOME',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::WLugSN3ssLc3FSw9' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getCustomerRequests/date',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerRequestController@searchCustomerRequestsbyDate',
        'controller' => 'App\\Http\\Controllers\\CustomerRequestController@searchCustomerRequestsbyDate',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::WLugSN3ssLc3FSw9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::sxCZaW3gujWVwvXR' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getApprovedCustomers/date',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerRequestController@searchApprovedCustomersbyDate',
        'controller' => 'App\\Http\\Controllers\\CustomerRequestController@searchApprovedCustomersbyDate',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::sxCZaW3gujWVwvXR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::dq5RZ5U8IgbCY7gy' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'approveCustomer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerRequestController@approveCustomer',
        'controller' => 'App\\Http\\Controllers\\CustomerRequestController@approveCustomer',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::dq5RZ5U8IgbCY7gy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::mnkANXsqsW95KA8M' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getApprovedCustomers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerRequestController@getApprovedCustomers',
        'controller' => 'App\\Http\\Controllers\\CustomerRequestController@getApprovedCustomers',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::mnkANXsqsW95KA8M',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::WbPz0uuSuhflbDeF' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getApprovedCustomers/customers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerRequestController@searchApprovedCustomers',
        'controller' => 'App\\Http\\Controllers\\CustomerRequestController@searchApprovedCustomers',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::WbPz0uuSuhflbDeF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::gROOJtaGrCpdpR6D' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rejectCustomer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerRequestController@rejectCustomer',
        'controller' => 'App\\Http\\Controllers\\CustomerRequestController@rejectCustomer',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::gROOJtaGrCpdpR6D',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::AKdCvbOBN4cVWr5Z' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getRejectedCustomers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerRequestController@getRejectedCustomers',
        'controller' => 'App\\Http\\Controllers\\CustomerRequestController@getRejectedCustomers',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::AKdCvbOBN4cVWr5Z',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::wrPt7YRUtFm6yPVu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getRejectedCustomers/customers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerRequestController@searchRejectedCustomers',
        'controller' => 'App\\Http\\Controllers\\CustomerRequestController@searchRejectedCustomers',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::wrPt7YRUtFm6yPVu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::J5nLMf0FSdu01Uyr' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'importitemsbulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportBulkController@importitemsbulk',
        'controller' => 'App\\Http\\Controllers\\ImportBulkController@importitemsbulk',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::J5nLMf0FSdu01Uyr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::48u2E0U8ukxK6QxX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getItemsBulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportBulkController@getItemsBulk',
        'controller' => 'App\\Http\\Controllers\\ImportBulkController@getItemsBulk',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::48u2E0U8ukxK6QxX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::SwX1yk1eAp0RIzhd' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getItemsBulk/item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportBulkController@searchItemsBulk',
        'controller' => 'App\\Http\\Controllers\\ImportBulkController@searchItemsBulk',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::SwX1yk1eAp0RIzhd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::KeLEDeBoDQ89r5j3' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'importItemsFlowrack',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportFlowrackController@importItemsFlowrack',
        'controller' => 'App\\Http\\Controllers\\ImportFlowrackController@importItemsFlowrack',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::KeLEDeBoDQ89r5j3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ZgzLti040BxJYJ8k' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'importItemsBCOM',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportBCOMController@importItemsBCOM',
        'controller' => 'App\\Http\\Controllers\\ImportBCOMController@importItemsBCOM',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::ZgzLti040BxJYJ8k',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::2kO53J7F2JV5q0uL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getItemsBCOM',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportBCOMController@getItemsBCOM',
        'controller' => 'App\\Http\\Controllers\\ImportBCOMController@getItemsBCOM',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::2kO53J7F2JV5q0uL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::KiUPlXW1zdP5eCLx' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getItemsBCOM/item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportBCOMController@searchItemsBCOM',
        'controller' => 'App\\Http\\Controllers\\ImportBCOMController@searchItemsBCOM',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::KiUPlXW1zdP5eCLx',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::qW0Hae6iG7FPoMwP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getItemsFlowrack',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportFlowrackController@getItemsFlowrack',
        'controller' => 'App\\Http\\Controllers\\ImportFlowrackController@getItemsFlowrack',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::qW0Hae6iG7FPoMwP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::r8KSTvXy3jLxonvg' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getItemsFlowrack/item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportFlowrackController@searchItemsFlowrack',
        'controller' => 'App\\Http\\Controllers\\ImportFlowrackController@searchItemsFlowrack',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::r8KSTvXy3jLxonvg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::YmvLpjp1SMGYsn1r' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'exportCustomerRequest',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerRequestController@exportCustomerRequest',
        'controller' => 'App\\Http\\Controllers\\CustomerRequestController@exportCustomerRequest',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::YmvLpjp1SMGYsn1r',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::rU2ssElrTQKMvw3L' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'approvedBy',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\CustomerRequestController@approvedBy',
        'controller' => 'App\\Http\\Controllers\\CustomerRequestController@approvedBy',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::rU2ssElrTQKMvw3L',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::lWQB8oweSRNWf4F6' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'principal/create_supplier',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TblPrincipalController@create_supplier',
        'controller' => 'App\\Http\\Controllers\\TblPrincipalController@create_supplier',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/principal',
        'where' => 
        array (
        ),
        'as' => 'generated::lWQB8oweSRNWf4F6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::OA8ob8zN9lFu0VNa' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'principal/get_supplier',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TblPrincipalController@get_supplier',
        'controller' => 'App\\Http\\Controllers\\TblPrincipalController@get_supplier',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/principal',
        'where' => 
        array (
        ),
        'as' => 'generated::OA8ob8zN9lFu0VNa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::SWPfYbQ8EpHP4UbE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'principal/get_supplier/name',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TblPrincipalController@searchSupplier',
        'controller' => 'App\\Http\\Controllers\\TblPrincipalController@searchSupplier',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/principal',
        'where' => 
        array (
        ),
        'as' => 'generated::SWPfYbQ8EpHP4UbE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::XMlw90P35YEjCj8n' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'principal/toggleSupplier',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TblPrincipalController@toggleSupplier',
        'controller' => 'App\\Http\\Controllers\\TblPrincipalController@toggleSupplier',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/principal',
        'where' => 
        array (
        ),
        'as' => 'generated::XMlw90P35YEjCj8n',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::v4vhhAoLV2lBkL1A' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'principal/get_supplier/dis',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TblPrincipalController@searchDis',
        'controller' => 'App\\Http\\Controllers\\TblPrincipalController@searchDis',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/principal',
        'where' => 
        array (
        ),
        'as' => 'generated::v4vhhAoLV2lBkL1A',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ZyHqiyZaCIHNxeZb' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'principal/postDiscount',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TblPrincipalController@postDiscount',
        'controller' => 'App\\Http\\Controllers\\TblPrincipalController@postDiscount',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/principal',
        'where' => 
        array (
        ),
        'as' => 'generated::ZyHqiyZaCIHNxeZb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::7wcxbLaScNe6Uffp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'discount/getItems',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TblDiscount@getItems',
        'controller' => 'App\\Http\\Controllers\\TblDiscount@getItems',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/discount',
        'where' => 
        array (
        ),
        'as' => 'generated::7wcxbLaScNe6Uffp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::zmHDkqP8Tsug3B66' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'discount/getItems/name',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TblDiscount@searchItems',
        'controller' => 'App\\Http\\Controllers\\TblDiscount@searchItems',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/discount',
        'where' => 
        array (
        ),
        'as' => 'generated::zmHDkqP8Tsug3B66',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::z8zikhnZAOI6ilaK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'discount/getItems/withCategory',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TblDiscount@getItems',
        'controller' => 'App\\Http\\Controllers\\TblDiscount@getItems',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/discount',
        'where' => 
        array (
        ),
        'as' => 'generated::z8zikhnZAOI6ilaK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::gAlhVsBH4Qk90M6y' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'discount/postDiscount',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TblDiscount@postDiscount',
        'controller' => 'App\\Http\\Controllers\\TblDiscount@postDiscount',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/discount',
        'where' => 
        array (
        ),
        'as' => 'generated::gAlhVsBH4Qk90M6y',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ZHPfxWDjk3lYt1Xu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesreport/getSalesman',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesReportController@getSalesman',
        'controller' => 'App\\Http\\Controllers\\SalesReportController@getSalesman',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesreport',
        'where' => 
        array (
        ),
        'as' => 'generated::ZHPfxWDjk3lYt1Xu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::NICeNEfMOQVMD3P4' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesreport/getCustomer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesReportController@getCustomer',
        'controller' => 'App\\Http\\Controllers\\SalesReportController@getCustomer',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesreport',
        'where' => 
        array (
        ),
        'as' => 'generated::NICeNEfMOQVMD3P4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::PCXqrVo2xaw35geM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesreport/selectAll',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesReportController@selectAll',
        'controller' => 'App\\Http\\Controllers\\SalesReportController@selectAll',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesreport',
        'where' => 
        array (
        ),
        'as' => 'generated::PCXqrVo2xaw35geM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::n0GvFzBXE4DG0pgr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesreport/customer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesReportController@getTransaction',
        'controller' => 'App\\Http\\Controllers\\SalesReportController@getTransaction',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesreport',
        'where' => 
        array (
        ),
        'as' => 'generated::n0GvFzBXE4DG0pgr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::DbH6oiXHm77jh1jB' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesreport/ptype',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesReportController@ptype',
        'controller' => 'App\\Http\\Controllers\\SalesReportController@ptype',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesreport',
        'where' => 
        array (
        ),
        'as' => 'generated::DbH6oiXHm77jh1jB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::xSzXeoe2Ujssq99J' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesreport/ptypeAll',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesReportController@ptypeAll',
        'controller' => 'App\\Http\\Controllers\\SalesReportController@ptypeAll',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesreport',
        'where' => 
        array (
        ),
        'as' => 'generated::xSzXeoe2Ujssq99J',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Cs1cA9uMotgltPYi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesreport/printReport',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesReportController@printReport',
        'controller' => 'App\\Http\\Controllers\\SalesReportController@printReport',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesreport',
        'where' => 
        array (
        ),
        'as' => 'generated::Cs1cA9uMotgltPYi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::FrTmufOudrMCRuJq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesreport/printReport2',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesReportController@printReport2',
        'controller' => 'App\\Http\\Controllers\\SalesReportController@printReport2',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesreport',
        'where' => 
        array (
        ),
        'as' => 'generated::FrTmufOudrMCRuJq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::zXplA1zUoB1qhddw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesreport/getJepe',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesReportController@getJepe',
        'controller' => 'App\\Http\\Controllers\\SalesReportController@getJepe',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesreport',
        'where' => 
        array (
        ),
        'as' => 'generated::zXplA1zUoB1qhddw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::I3KEoi1Y4HJX644P' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesreport/getJepeSales',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesReportController@getJepeSales',
        'controller' => 'App\\Http\\Controllers\\SalesReportController@getJepeSales',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesreport',
        'where' => 
        array (
        ),
        'as' => 'generated::I3KEoi1Y4HJX644P',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ePB79blAuiEUXhvW' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesreport/salesReportJepe/printSummary',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesReportController@printSummary',
        'controller' => 'App\\Http\\Controllers\\SalesReportController@printSummary',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => 'salesreport/salesReportJepe',
        'where' => 
        array (
        ),
        'as' => 'generated::ePB79blAuiEUXhvW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::l6VE6fWCZkz5V39p' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesreport/getOrderHistory',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesReportController@getOrderHistory',
        'controller' => 'App\\Http\\Controllers\\SalesReportController@getOrderHistory',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesreport',
        'where' => 
        array (
        ),
        'as' => 'generated::l6VE6fWCZkz5V39p',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::hgQGJtmsIoIdPft5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'salesreport/printOrderHistory',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\SalesReportController@printOrderHistory',
        'controller' => 'App\\Http\\Controllers\\SalesReportController@printOrderHistory',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/salesreport',
        'where' => 
        array (
        ),
        'as' => 'generated::hgQGJtmsIoIdPft5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::AN7Vi4HAHy7JDZgK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/topProducts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@topProducts',
        'controller' => 'App\\Http\\Controllers\\TopReports@topProducts',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::AN7Vi4HAHy7JDZgK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::iNzFxTlONiDy2z8O' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/topProducts/search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@topProducts',
        'controller' => 'App\\Http\\Controllers\\TopReports@topProducts',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::iNzFxTlONiDy2z8O',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::qobFPz1YouFAWa5y' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/printTopProducts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@printTopProducts',
        'controller' => 'App\\Http\\Controllers\\TopReports@printTopProducts',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::qobFPz1YouFAWa5y',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::CRAJchlghYm0eJHd' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/topCustomers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@topCustomers',
        'controller' => 'App\\Http\\Controllers\\TopReports@topCustomers',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::CRAJchlghYm0eJHd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::0GHnTjjIDPoFeCVf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/topCustomers/search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@topCustomers',
        'controller' => 'App\\Http\\Controllers\\TopReports@topCustomers',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::0GHnTjjIDPoFeCVf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::9ZiUitPiQgKwpg5e' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/printTopCustomer',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@printTopCustomer',
        'controller' => 'App\\Http\\Controllers\\TopReports@printTopCustomer',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::9ZiUitPiQgKwpg5e',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::rA35xk9hJ3R6zRoG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/topSalesman',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@topSalesman',
        'controller' => 'App\\Http\\Controllers\\TopReports@topSalesman',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::rA35xk9hJ3R6zRoG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::KjBuZNTxaOoMvMvM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/topSalesman/search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@topSalesman',
        'controller' => 'App\\Http\\Controllers\\TopReports@topSalesman',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::KjBuZNTxaOoMvMvM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::UB52jnLXigDEe0xI' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/printTopSalesman',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@printTopSalesman',
        'controller' => 'App\\Http\\Controllers\\TopReports@printTopSalesman',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::UB52jnLXigDEe0xI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Pc27RATXvYZSVmP1' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/topJepe',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@topJepe',
        'controller' => 'App\\Http\\Controllers\\TopReports@topJepe',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::Pc27RATXvYZSVmP1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::dPg8RRXhxYJvkvQs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/topJepe/search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@topJepe',
        'controller' => 'App\\Http\\Controllers\\TopReports@topJepe',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::dPg8RRXhxYJvkvQs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::k1XhiiTUhAP1wQQv' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/printTopJepe',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@printTopJepe',
        'controller' => 'App\\Http\\Controllers\\TopReports@printTopJepe',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::k1XhiiTUhAP1wQQv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::8bJPDbyLibOYa2WH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/totalOrderCount',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@totalOrderCount',
        'controller' => 'App\\Http\\Controllers\\TopReports@totalOrderCount',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::8bJPDbyLibOYa2WH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Z07pxaoiAzWajga2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/printTotalOrderCount',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@printTotalOrderCount',
        'controller' => 'App\\Http\\Controllers\\TopReports@printTotalOrderCount',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::Z07pxaoiAzWajga2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::1Khmve5O82GvnVOz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/sourceOrderCount',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@sourceOrderCount',
        'controller' => 'App\\Http\\Controllers\\TopReports@sourceOrderCount',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::1Khmve5O82GvnVOz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::nT9t7euO9HkzZYla' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'topReports/printsourceOrderCount',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\TopReports@printsourceOrderCount',
        'controller' => 'App\\Http\\Controllers\\TopReports@printsourceOrderCount',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/topReports',
        'where' => 
        array (
        ),
        'as' => 'generated::nT9t7euO9HkzZYla',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::7dTza3WvRtbN4a9x' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'viewingUsers/getviewingUsers',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ViewingUsersController@getviewingUsers',
        'controller' => 'App\\Http\\Controllers\\ViewingUsersController@getviewingUsers',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/viewingUsers',
        'where' => 
        array (
        ),
        'as' => 'generated::7dTza3WvRtbN4a9x',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Wphylwco9GKKFLAN' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'viewingUsers/toggleStatus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ViewingUsersController@toggleStatus',
        'controller' => 'App\\Http\\Controllers\\ViewingUsersController@toggleStatus',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/viewingUsers',
        'where' => 
        array (
        ),
        'as' => 'generated::Wphylwco9GKKFLAN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::ZETYpdg3vpBLRlPi' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'viewingUsers/newViewingUser',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ViewingUsersController@newViewingUser',
        'controller' => 'App\\Http\\Controllers\\ViewingUsersController@newViewingUser',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/viewingUsers',
        'where' => 
        array (
        ),
        'as' => 'generated::ZETYpdg3vpBLRlPi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::UP4i3pIUz1O2g0M6' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'viewingUsers/getMaxCode',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ViewingUsersController@getMaxCode',
        'controller' => 'App\\Http\\Controllers\\ViewingUsersController@getMaxCode',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/viewingUsers',
        'where' => 
        array (
        ),
        'as' => 'generated::UP4i3pIUz1O2g0M6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::8BbfHfLpaQAMy4aQ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'feedbacks/getResults',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\FeedBackController@getResults',
        'controller' => 'App\\Http\\Controllers\\FeedBackController@getResults',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/feedbacks',
        'where' => 
        array (
        ),
        'as' => 'generated::8BbfHfLpaQAMy4aQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::Fu9yaJBFOvXJgys5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'getAuthUser',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@getAuthUser',
        'controller' => 'App\\Http\\Controllers\\HomeController@getAuthUser',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::Fu9yaJBFOvXJgys5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'import_file' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'import_masterfile/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ItemMasterfileController@item_masterfile_import',
        'controller' => 'App\\Http\\Controllers\\ItemMasterfileController@item_masterfile_import',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'import_file',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::RnhBKLQF2xvNaye0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'fixes/restore-lost-trans',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Fixes\\RestoreLostTrans@index',
        'controller' => 'App\\Http\\Controllers\\Fixes\\RestoreLostTrans@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '/fixes',
        'where' => 
        array (
        ),
        'as' => 'generated::RnhBKLQF2xvNaye0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::0XmOxb028S6OSgZv' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'grouped-items-upload',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportGroupedItemsController@groupedItemsUpload',
        'controller' => 'App\\Http\\Controllers\\ImportGroupedItemsController@groupedItemsUpload',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::0XmOxb028S6OSgZv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::46WNx5L8vFMxwArL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{any}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@index',
        'controller' => 'App\\Http\\Controllers\\HomeController@index',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::46WNx5L8vFMxwArL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'any' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
  ),
)
);
