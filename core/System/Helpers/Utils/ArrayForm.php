<?php

/**
 * ArrayForm Class
 *
 * Responsible for building forms
 * Usage
 *
 * @param array $elements renderable array containing form elements
 *
 * @return void
 */

namespace LexSystems\Framework\Kernel\Helpers\Utils;

class ArrayForm
{

    /**
     * @var array
     *
     * [
    'id' => 'nume',
    'type' => 'text',
    'label' => 'Nume',
    'name' => 'first_name',
    'required' => 'true'
    ],
    [
    'id' => 'prenume',
    'type' => 'text',
    'label' => 'Prenume',
    'name' => 'last_name',
    'required' => 'true'
    ],
     *
     * [
     * 'id' => 'button',
     * 'type' => 'submit',
     * 'name' => 'name',
     * 'value' => 'value'
     * ]
     */

    protected $elements;
    protected $formData = [];
    protected $formNo = 0;
    protected $id;

    public function __construct(array $elements = [],array $formData = [])
    {
        $this->formData = array_merge(
            [
                "method" => "post",
                "display" => "div",
                "action" => ""
            ],
            $formData
        );
        $this->elements = $elements;
        $this->id = isset($formData["id"]) ? $formData["id"] : rand(9, 1000);
    }

    /**
     * Form class method to dump object elements
     *
     * The method just dumps the elements of the form passed to the instantiation.
     *
     * @return void
     *
     */
    public function dumpData()
    {
       return ['form' => $this->formData,'elements' => $this->elements];
    }

    /**
     * Form class method to build a form from an array
     *
     *
     * @return string $output contains the form as HTML
     *
     */
    public function build()
    {

        // For multiple forms, create a counter.
        $this->formNo++;

        $input = $this->renderInputs();
        return $this->printOutput($input);
    }

    protected function renderInputs()
    {
        $output = "";
        $hidden = "";
        // Loop through each form element and render it.
        foreach ($this->elements as $element) {

            //Values to be reset for each input
            $opts = $input = $label = $attributes = "";


            //Extract key data from attributes
            $id = isset($element["id"]) ? htmlspecialchars($element["id"]) : null;
            $name = isset($element["name"]) ? htmlspecialchars($element["name"]) : null;
            $options = isset($element["options"]) ? $element["options"] : null;
            $wrapper = isset($element["wrapper"]) ? $element["wrapper"] : [];
            $default = isset($element["deafult"]) ? htmlspecialchars($element["default"]) : null;
            $class = isset($element["class"]) ? $element["class"] : null;
            $type = isset($element["type"]) ? htmlspecialchars($element["type"]) : "text";
            $label = isset($element["label"]) ? htmlspecialchars($element["label"]) : null;
            $value = isset($element["value"]) ? htmlspecialchars($element["value"]) : null;
            unset(
                $element["id"],
                $element["name"],
                $element["options"],
                $element["type"],
                $element["wrapper"],
                $element["default"],
                $element["class"],
                $element["label"],
                $element["value"]
            );

            //Input ID
            $inputID = $id;

            //Create Attributes
            foreach ($element as $attr => $val) {

                $val = htmlspecialchars($val);

                if (gettype($val) === true) {
                    $attributes .= "$attr=\"$attr\" ";
                }
                if (gettype($val) === false) {

                } else {
                    $attributes .= "$attr=\"$val\" ";
                }
            }

            //Create Attributes
            $wrapper_attr = "";
            foreach ($wrapper as $attr => $val) {

                $val = htmlspecialchars($val);
                $wrapper_attr .= "$attr=\"$val\" ";
            }

            //Create options
            $label = "<label for=\"$inputID\">$label</label>";

            switch ($type) {
                case "textarea":
                    $input = "<textarea id=\"$inputID\" name=\"$name\" value=\"$default\" class=\"$class\" $attributes></textarea>";
                    break;
                case "select":
                    foreach ($options as $key => $val) {
                        //if (is_numeric($key)) {
                        //   $value = "";
                        // } else {
                        //$key = htmlspecialchars($key);
                        //
                        //}
                        $value = "value=\"$key\"";
                        $opts .= "\n		<option $value>$val</option>";
                    }
                    $input = "<select id=\"$inputID\" name=\"$name\" $attributes class=\"$class\" value=\"$default\">$opts\n	</select>";

                    break;
                case "radio":
                   $input = "<input id=\"$inputID\" type=\"checkbox\" class=\"$class\" name=\"$name\" $attributes value=\"$value\" />";
                case "checkbox":
                    foreach ($options as $key => $val) {
                        if (is_numeric($key)) {
                            $val = htmlspecialchars($val);
                            $value = "value=\"$val\"";
                        } else {
                            $key = htmlspecialchars($key);
                            $value = "value=\"$key\"";
                        }
                        $input .= "\n<label><input type=\"$type\" name=\"$name\" class=\"$class\" $attributes $value/>$val</label>";
                    }

                    break;
                case "submit":
                    $input = "<button type=\"submit\" name=\"$name\" class=\"$class\">$value</button>";
                    $label = "";
                    break;
                case "custom":
                    $input = $element["custom"];
                    $label = "";
                    break;
                case "button":
                    $input = '<button type="'.$type.'" name="'.$name.'" class="'.$class.'" '.$attributes.'>'.$value.'</button>';
                    break;
                default:
                    $input = "<input id=\"$inputID\" type=\"$type\" class=\"$class\" name=\"$name\" $attributes value=\"$value\" />";

            }
            if ($type == "hidden") {
                $hidden .= '<input type="hidden" name="' . $name . '" value="' . $value . '">';
                continue;
            }
//            switch ($this->formData["display"]) {
//
//                case "table":
//                    $output .= <<<INPUT
//					<tr $wrapper_attr>
//						<td class="DFForm-input-title">$label</td>
//						<td class="DFForm-input-content">$input</td>
//					</tr>
//INPUT;
//                    break;
//
//                default:
//                    $output .= <<<INPUT
//					<div $wrapper_attr class="form-group">
//						$label
//						<div>$input</div>
//					</div>
//
//INPUT;
//
//            }

            if($this->formData['display'] == 'table')
            {
                $output .= '<tr '.$wrapper_attr.'>';
                $output .= '<td class="DFForm-input-title">'.$label.'</td>';
                $output .= '<td class="DFForm-input-content">'.$input.'</td>';
                $output .= '</tr>';
            }
            else
            {
                $output .= '<div '.$wrapper_attr.' class="form-group">';
                $output .= $label;
                $output .= '<div>'.$input.'</div>';
                $output .= '</div>';
            }

        }


        return [$output, $hidden];

    }

    /**
     * @param $inputs
     * @return string
     */
    protected function printOutput($inputs)
    {

        $output = $inputs[0];
        $hidden = $inputs[1];

        $formData = $this->formData;
        $class = isset($formData['class']) ? $formData['class'] : null;

        unset(
            $formData["id"],
            $formData["class"],
            $formData["class"]
        );
        $attributes = null;
        foreach ($formData as $attr => $val) {

            $val = htmlspecialchars($val);
            $attributes .= "$attr='$val' ";
        }

        //HTML wrapper for all inputs
        $wrapper = ($this->formData["display"] == "table") ? ["<table class='DFForm-table'>", "</table>"] : ["", ""];

        return "
		<form id='DFF$this->id-$this->formNo' class='DFForm $class' $attributes>
			 $wrapper[0] $output $wrapper[1] $hidden
		</form>";
    }
}
