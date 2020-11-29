<?php
/**
* This library extends the CI native Table.php library
* and adds the table footer feature
* Footer can be formatted with newly added config options
*    'tfoot_open'
*    'tfoot_close'
*    'footer_row_start'
*    'footer_row_end'
*    'footer_cell_start'
*    'footer_cell_end'
* (see end of this file for defaults)
* Footer content can be added using function
* $this->table->set_footer(array('Col1 content', 'Col2 content'));
*
* This file should be placed in
* ./application/libraries/
* and named MY_Table.php
*
* By Donatas Glodenis, https://dg.lapas.info/?page_id=3141
* based on Codeigniter (3.1.2) Table.php library
* ideas borrowed from http://stackoverflow.com/a/17914885
* 2016-12-18
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Table extends CI_Table {

  /**
  * Data for table footer
  *
  * @var array
  */
  public $footer        = array();
 
  /**
  * Set the template from the table config file if it exists
  *
  * @param    array    $config    (default: array())
  * @return    void
  */
  public function __construct($config = array())
  {
      parent::__construct($config);
  }

  /**
  * Set the table footer
  *
  * Can be passed as an array or discreet params
  *
  * @param    mixed
  * @return    CI_Table
  */
  public function set_footer($args = array())
  {
    $this->footer = $this->_prep_args(func_get_args());
    return $this;
  }

  /**
  * Clears the table arrays.  Useful if multiple tables are being generated
  *
  * @return    CI_Table
  */
  public function clear()
  {
    $this->rows = array();
    $this->heading = array();
    $this->footer = array();
    $this->auto_heading = TRUE;
    return $this;
  }

  /**
  * Generate the table: extended by Donatas
  *
  * @param    mixed    $table_data
  * @return    string
  */
  public function generate($table_data = NULL)
  {
    // The table data can optionally be passed to this function
    // either as a database result object or an array
    if ( ! empty($table_data))
    {
      if ($table_data instanceof CI_DB_result)
      {
        $this->_set_from_db_result($table_data);
      }
      elseif (is_array($table_data))
      {
        $this->_set_from_array($table_data);
      }
    }

    // Is there anything to display? No? Smite them!
    if (empty($this->heading) && empty($this->rows))
    {
      return 'Undefined table data';
    }

    // Compile and validate the template date
    $this->_compile_template();

    // Validate a possibly existing custom cell manipulation function
    if (isset($this->function) && ! is_callable($this->function))
    {
      $this->function = NULL;
    }

    // Build the table!

    $out = $this->template['table_open'].$this->newline;

    // Add any caption here
    if ($this->caption)
    {
      $out .= '<caption>'.$this->caption.'</caption>'.$this->newline;
    }

    // Is there a table heading to display?
    if ( ! empty($this->heading))
    {
      $out .= $this->template['thead_open'].$this->newline.$this->template['heading_row_start'].$this->newline;

      foreach ($this->heading as $heading)
      {
        $temp = $this->template['heading_cell_start'];

        foreach ($heading as $key => $val)
        {
          if ($key !== 'data')
          {
            $temp = str_replace('<th', '<th '.$key.'="'.$val.'"', $temp);
          }
        }

        $out .= $temp.(isset($heading['data']) ? $heading['data'] : '').$this->template['heading_cell_end'];
      }

      $out .= $this->template['heading_row_end'].$this->newline.$this->template['thead_close'].$this->newline;
    }

    // donatas: pridėtas if blokas, analogiškas aukščiau esančiam heading blokui
    if ( ! empty($this->footer))
    {
      $out .= $this->template['tfoot_open'].$this->newline.$this->template['footer_row_start'].$this->newline;

      foreach ($this->footer as $footer)
      {
        $temp = $this->template['footer_cell_start'];

        foreach ($footer as $key => $val)
        {
          if ($key != 'data')
          {
            $temp = str_replace('<th', '<th '.$key.'="'.$val.'"', $temp);
          }
        }

        $out .= $temp.(isset($footer['data']) ? $footer['data'] : '').$this->template['footer_cell_end'];
      }

      $out .= $this->template['footer_row_end'].$this->newline.$this->template['tfoot_close'].$this->newline;
    }

    // Build the table rows
    if ( ! empty($this->rows))
    {
      $out .= $this->template['tbody_open'].$this->newline;

      $i = 1;
      foreach ($this->rows as $row)
      {
        if ( ! is_array($row))
        {
          break;
        }

        // We use modulus to alternate the row colors
        $name = fmod($i++, 2) ? '' : 'alt_';

        $out .= $this->template['row_'.$name.'start'].$this->newline;

        foreach ($row as $cell)
        {
          $temp = $this->template['cell_'.$name.'start'];

          foreach ($cell as $key => $val)
          {
            if ($key !== 'data')
            {
              $temp = str_replace('<td', '<td '.$key.'="'.$val.'"', $temp);
            }
          }

          $cell = isset($cell['data']) ? $cell['data'] : '';
          $out .= $temp;

          if ($cell === '' OR $cell === NULL)
          {
            $out .= $this->empty_cells;
          }
          elseif (isset($this->function))
          {
            $out .= call_user_func($this->function, $cell);
          }
          else
          {
            $out .= $cell;
          }

          $out .= $this->template['cell_'.$name.'end'];
        }

        $out .= $this->template['row_'.$name.'end'].$this->newline;
      }

      $out .= $this->template['tbody_close'].$this->newline;
    }

    $out .= $this->template['table_close'];

    // Clear table class properties before generating the table
    $this->clear();

    return $out;
  }
 
  /**
  * Compile Template
  *
  * @return    void
  */
  protected function _compile_template()
  {
    if ($this->template === NULL)
    {
      $this->template = $this->_default_template();
      return;
    }
    // Adding footer strings after header strings
    $this->temp = $this->_default_template();
    foreach (array('table_open', 'thead_open', 'thead_close', 'heading_row_start', 'heading_row_end', 'heading_cell_start', 'heading_cell_end', 'tfoot_open', 'tfoot_close', 'footer_row_start', 'footer_row_end', 'footer_cell_start', 'footer_cell_end', 'tbody_open', 'tbody_close', 'row_start', 'row_end', 'cell_start', 'cell_end', 'row_alt_start', 'row_alt_end', 'cell_alt_start', 'cell_alt_end', 'table_close') as $val)
    {
      if ( ! isset($this->template[$val]))
      {
        $this->template[$val] = $this->temp[$val];
      }
    }
  }
 
  // --------------------------------------------------------------------

  /**
  * Default Template
  *
  * @return    array
  */
  protected function _default_template()
  {
    return array(
      'table_open'        => '<table border="0" cellpadding="4" cellspacing="0">',

      'thead_open'        => '<thead>',
      'thead_close'        => '</thead>',

      'heading_row_start'    => '<tr>',
      'heading_row_end'    => '</tr>',
      'heading_cell_start'    => '<th>',
      'heading_cell_end'    => '</th>',

      'tbody_open'        => '<tbody>',
      'tbody_close'        => '</tbody>',

      'row_start'        => '<tr>',
      'row_end'        => '</tr>',
      'cell_start'        => '<td>',
      'cell_end'        => '</td>',

      'row_alt_start'        => '<tr>',
      'row_alt_end'        => '</tr>',
      'cell_alt_start'    => '<td>',
      'cell_alt_end'        => '</td>',
      
 
      //New config options: default styles for footer
      'tfoot_open'            => '<tfoot>',
      'tfoot_close'           => '</tfoot>',
      
      'footer_row_start'      => '<tr>',
      'footer_row_end'        => '</tr>',
      'footer_cell_start'     => '<th>',
      'footer_cell_end'       => '</th>',

      'table_close'        => '</table>'
    );
  }
}

/* End of file MY_Table.php */
/* Location: ./application/libraries/MY_Table.php */