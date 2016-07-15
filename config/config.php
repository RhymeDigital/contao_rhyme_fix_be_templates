<?php

/**
 * Copyright (C) 2016 Rhyme Digital, LLC.
 * 
 * @author		Blair Winans <blair@rhyme.digital>
 * @author		Adam Fisher <adam@rhyme.digital>
 * @author		Cassondra Hayden <cassie@rhyme.digital>
 * @author		Melissa Frechette <melissa@rhyme.digital>
 * @link		http://rhyme.digital
 * @license		http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Override default namespace
 */
class_alias('Contao\BaseTemplate', 'Replaced\BaseTemplate');
class_alias('Rhyme\BaseTemplate', '\BaseTemplate');