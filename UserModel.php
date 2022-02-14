<?php

namespace phpcodemvc/phpmvcframwork;

use phpcodemvc/phpmvcframwork\db\DbModel;

abstract class UserModel extends DbModel
 {
     abstract public function getDisplayName(): string;
   

}
