<?php
/*-------------------------------------------------------+
| SYSTOPIA SQL Contact Search (Caution)                  |
| Copyright (C) 2017 SYSTOPIA                            |
| Author: B. Endres (endres -at- systopia.de)            |
| http://www.systopia.de/                                |
+--------------------------------------------------------+
| This program is released as free software under the    |
| Affero GPL license. You can redistribute it and/or     |
| modify it under the terms of this license which you    |
| can read by viewing the included agpl.txt or online    |
| at www.gnu.org/licenses/agpl.html. Removal of this     |
| copyright header is strictly prohibited without        |
| written permission from the original author(s).        |
+-------------------------------------------------------*/

/**
 * A custom contact search
 */
class CRM_Sqlsearch_Form_Search_SQLSearch extends CRM_Contact_Form_Search_Custom_Base implements CRM_Contact_Form_Search_Interface {

  function __construct(&$formValues) {
    parent::__construct($formValues);
  }

  /**
   * Prepare a set of search fields
   *
   * @param CRM_Core_Form $form modifiable
   * @return void
   */
  function buildForm(&$form) {
    CRM_Utils_System::setTitle(ts('SQL Contact Search'));

    // add SELECT field
    // $form->add(
    //   'textarea',
    //   'search_select',
    //   ts("SELECT", array('domain' => 'de.systopia.sqlsearch')),
    //   array('rows' => 6,
    //         'cols' => 80,
    //   ),
    //   FALSE
    // );

    // add FROM field
    $form->add(
      'textarea',
      'search_from',
      ts("FROM", array('domain' => 'de.systopia.sqlsearch')),
      array('rows' => 6,
            'cols' => 60,
      ),
      FALSE
    );

    // add WHERE field
    $form->add(
      'textarea',
      'search_where',
      ts("WHERE", array('domain' => 'de.systopia.sqlsearch')),
      array('rows' => 6,
            'cols' => 60,
      ),
      FALSE
    );

    // add HAVING field
    $form->add(
      'textarea',
      'search_having',
      ts("HAVING", array('domain' => 'de.systopia.sqlsearch')),
      array('rows' => 6,
            'cols' => 60,
      ),
      FALSE
    );

    // Optionally define default search values
    $form->setDefaults(array(
      'search_select' => '',
      'search_from'   => '',
      'search_where'  => 'contact_a.is_deleted = 0',
      'search_having' => '',
    ));

  }

  /**
   * Get a list of displayable columns
   *
   * @return array, keys are printable column headers and values are SQL column names
   */
  function &columns() {
    // return by reference
    $columns = array(
      ts('Contact ID')   => 'contact_id',
      ts('Contact Type') => 'contact_type',
      ts('Sort Name')    => 'sort_name',
    );
    return $columns;
  }

  /**
   * Construct a full SQL query which returns one page worth of results
   *
   * @param int $offset
   * @param int $rowcount
   * @param null $sort
   * @param bool $includeContactIDs
   * @param bool $justIDs
   * @return string, sql
   */
  function all($offset = 0, $rowcount = 0, $sort = NULL, $includeContactIDs = FALSE, $justIDs = FALSE) {
    // delegate to $this->sql(), $this->select(), $this->from(), $this->where(), etc.
    return $this->sql($this->select(), $offset, $rowcount, $sort, $includeContactIDs, 'GROUP BY contact_a.id');

  }

  /**
   * override parent's function for debugging
   */
  function sql($selectClause, $offset = 0, $rowcount = 0, $sort = NULL, $includeContactIDs = FALSE, $groupBy = NULL) {
    // add having clause
    if (!empty($this->_formValues['search_having'])) {
      $groupBy .= ' HAVING ' . html_entity_decode($this->_formValues['search_having']);
    }

    $sql = parent::sql($selectClause, $offset, $rowcount, $sort, $includeContactIDs, $groupBy);
    // error_log($sql);
    return $sql;
  }

  /**
   * Construct a SQL SELECT clause
   *
   * @return string, sql fragment with SELECT arguments
   */
  function select() {
    $select = "contact_a.id           as contact_id,
               contact_a.contact_type as contact_type,
               contact_a.sort_name    as sort_name";
    // if (!empty($this->_formValues['search_select'])) {
    //   $select .= ', ' . $this->_formValues['search_select'];
    // }
    return $select;
  }

  /**
   * Construct a SQL FROM clause
   *
   * @return string, sql fragment with FROM and JOIN clauses
   */
  function from() {
    $from = "FROM civicrm_contact contact_a ";
    if (!empty($this->_formValues['search_from'])) {
      $from .= html_entity_decode($this->_formValues['search_from']);
    }

    return $from;
  }

  /**
   * Construct a SQL WHERE clause
   *
   * @param bool $includeContactIDs
   * @return string, sql fragment with conditional expressions
   */
  function where($includeContactIDs = FALSE) {
    if (!empty($this->_formValues['search_where'])) {
      return html_entity_decode($this->_formValues['search_where']);
    } else {
      return 'TRUE';
    }
  }

  /**
   * Determine the Smarty template for the search screen
   *
   * @return string, template path (findable through Smarty template path)
   */
  function templateFile() {
    return 'CRM/Sqlsearch/Form/Search/SQLSearch.tpl';
  }

  /**
   * Modify the content of each row
   *
   * @param array $row modifiable SQL result row
   * @return void
   */
  function alterRow(&$row) {
    // $row['sort_name'] .= ' ( altered )';
  }

  /**
   * Get a list of summary data points
   *
   * @return mixed; NULL or array with keys:
   *  - summary: string
   *  - total: numeric
   */
  function summary() {
    return NULL;
    // return array(
    //   'summary' => 'This is a summary',
    //   'total' => 50.0,
    // );
  }

}
