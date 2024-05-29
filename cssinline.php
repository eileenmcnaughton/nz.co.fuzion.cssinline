<?php

/*
 *  This file is part of nz.co.fuzion.cssinline.
 *
 *  Copyright 2014, Eileen McNaughton
 *
 *  nz.co.fuzion.cssinline is free software: you can redistribute it and/or
 *  modify it under the terms of the GNU Affero General Public License as
 *  published by the Free Software Foundation, either version 3 of the License,
 *  or (at your option) any later version.
 *
 *  nz.co.fuzion.cssinline is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero
 *  General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with Foobar.  If not, see <https://www.gnu.org/licenses/>.
 */

require_once 'cssinline.civix.php';

/**
 * Implementation of hook_civicrm_config
 */
function cssinline_civicrm_config(&$config) {
  _cssinline_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_install
 */
function cssinline_civicrm_install() {
  return _cssinline_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_enable
 */
function cssinline_civicrm_enable() {
  return _cssinline_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_caseTypes
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 */
function cssinline_civicrm_alterMailParams(&$mailParams, $context) {
  if (!empty($mailParams['html'])) {
    $mailParams['html'] = _cssinline_inlinecss($mailParams['html']);
  }
}

/**
 * convert css urls to inline css.
 *
 * Links in the format
 *   <link rel="stylesheet" type="text/css" href="http://civicrm.org/civicrm.css?mww2q8">
 * are converted such that css styles are added inline to individual elements
 * Note that gmail will ot render styling if not applied to to tags, other clients will
 * render script sections.
 */
function _cssinline_inlinecss($html) {
  require_once 'packages/cssin/src/CSSIN.php';
  $cssin = new FM\CSSIN();
  return  $cssin->inlineCSS(NULL, $html);
}
