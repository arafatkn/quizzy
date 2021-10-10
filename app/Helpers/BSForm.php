<?php

namespace App\Helpers;

class BSForm
{
    public function show($method, $action, $data, $submit = [])
    {
        echo '<form method="'.$method.'"';
        if (!empty($action) || strlen($action) > 0) {
            echo ' action="'.$action.'"';
        }
        echo '>';
        foreach ($data as $arr) {
            $fn = $arr[0];
            unset($arr[0]);
            $this->$fn($arr);
        }
        echo '<button type="submit" class="btn ';
        if (isset($submit["class"])) {
            echo $submit["class"];
        } else {
            echo 'btn-primary';
        }
        echo '"';
        if (isset($submit["extra"])) {
            echo ' '.$submit["extra"];
        }
        echo '>';
        if (isset($submit["value"])) {
            echo $submit["value"];
        } else {
            echo 'Submit';
        }
        echo '</button>';
        echo '</form>';
    }

    public function open($method, $action = '', $data = [])
    {
        $str = '<form action="'.$action.'" method="'.($method=='PUT'?'POST':$method).'" '.$this->printAttr($data).'>';
        $str .= '<input type="hidden" name="_token" value="'.csrf_token().'">';
        if ($method == 'PUT') {
            $str .= '<input type="hidden" name="_method" value="PUT">';
        }
        return $str;
    }

    public function close($submit, $text = 'Submit', $class = 'btn btn-success', $data = [])
    {
        if (!$submit) {
            return '</form>';
        }

        $str = $this->submit($text, $class, $data).'</form>';

        return $str;
    }

    public function printAttr($data)
    {
        $str = '';
        foreach ($data as $k => $v) {
            $str .= $k.'="'.$v.'" ';
        }
        return $str;
    }

    public function multiInput($datas)
    {
        $str = '';
        foreach ($datas as $data) {
            $str .= $this->input(
                $data[0],
                $data[1],
                isset($data[2]) ? $data[2] : '',
                isset($data[3]) ? $data[3] : '',
                isset($data[4]) ? $data[4] : []
            );
        }
        return $str;
    }

    public function multi($datas)
    {
        $str = '';
        foreach ($datas as $data) {
            $func = $data[0];
            $dc   = count($data);
            switch ($dc) {
                case 0:
                case 1:
                case 2:
                    break;

                case 3:
                    $str .= $this->$func($data[1], $data[2]);
                    break;

                case 4:
                    $str .= $this->$func($data[1], $data[2], $data[3]);
                    break;

                case 5:
                    $str .= $this->$func($data[1], $data[2], $data[3], $data[4]);
                    break;

                default:
                    $str .= $this->$func($data[1], $data[2], $data[3], $data[4], $data[5]);
                    break;
            }
        }

        return $str;
    }

    public function multiText($datas)
    {
        $str = '';
        foreach ($datas as $data) {
            $str .= $this->input(
                'text',
                $data[0],
                isset($data[1]) ? $data[1] : '',
                isset($data[2]) ? $data[2] : '',
                isset($data[3]) ? $data[3] : []
            );
        }
        return $str;
    }

    public function input($type, $name, $label = '', $value = '', $data = [])
    {
        $str = '
        <div class="form-group">';

        if (!empty($label)) {
            $str .= '<label for="'.$type.'">'.$label.':</label>';
        }

        $str .= '<input type="'.$type.'" class="form-control" name="'.$name.'" value="'.old(
                $name,
                $value
            ).'" '.$this->printAttr($data).'>';
        if ($type == "file") {
            $str .= '<img src="'.$value.'"/>';
        }
        $str .= '</div>';
        return $str;
    }

    public function select($name, $options, $label = '', $value = '', $data = [])
    {
        $str = '
        <div class="form-group">';

        if (!empty($label)) {
            $str .= '<label for="select">'.$label.':</label>';
        }

        $str .= '<select class="form-control" name="'.$name.'" '.$this->printAttr($data).'>';
        foreach ($options as $k => $v) {
            $str .= '<option value="'.$k.'"'.($k == old($name, $value) ? ' selected' : '').'>'.$v.'</option>';
        }
        $str .= '
            </select>
        </div>';
        return $str;
    }

    public function selectM($name, $options, $label = '', $value = [], $data = [])
    {
        $str = '
        <div class="form-group">';

        if (!empty($label)) {
            $str .= '<label for="select">'.$label.':</label>';
        }

        $str   .= '<select class="form-control" multiple="true" name="'.$name.'[]" '.$this->printAttr($data).'>';
        $value = old($name, $value);
        foreach ($options as $k => $v) {
            $str .= '<option value="'.$k.'"'.(in_array($k, $value) ? ' selected' : '').'>'.$v.'</option>';
        }
        $str .= '
            </select>
        </div>';
        return $str;
    }

    public function textarea($name, $label = '', $value = '', $data = [])
    {
        $str = '
        <div class="form-group">';

        if (!empty($label)) {
            $str .= '<label for="textarea">'.$label.':</label>';
        }

        $str .= '<textarea class="form-control" name="'.$name.'" '.$this->printAttr($data).'>'.old($name, $value).'</textarea>
        </div>';
        return $str;
    }

    // Input Types

    public function text($name, $label = '', $value = '', $data = [])
    {
        return $this->input('text', $name, $label, $value, $data);
    }

    public function password($name, $label = '', $value = '', $data = [])
    {
        return $this->input('password', $name, $label, $value, $data);
    }

    public function email($name, $label = '', $value = '', $data = [])
    {
        return $this->input('email', $name, $label, $value, $data);
    }

    public function number($name, $label = '', $value = '', $data = [])
    {
        return $this->input('number', $name, $label, $value, $data);
    }

    public function date($name, $label = '', $value = '', $data = [])
    {
        return $this->input('date', $name, $label, $value, $data);
    }

    public function datetime_local($name, $label = '', $value = '', $data = [])
    {
        return $this->input('datetime-local', $name, $label, $value, $data);
    }

    public function range($name, $label = '', $value = '', $data = [])
    {
        return $this->input('range', $name, $label, $value, $data);
    }

    public function file($name, $label = '', $value = '', $data = [])
    {
        return $this->input('file', $name, $label, $value, $data);
    }

    public function checkbox($name, $label = '', $value = '', $data = [])
    {
        $checked = old($name, $value) ? "checked" : "";
        $str     = '
        <div class="form-group form-check">
            <label for="checkbox" class="form-check-label">
                <input type="checkbox" class="form-check-input" name="'.$name.'" '.$checked.' '.$this->printAttr($data).'> '.$label.'
            </label>
        </div>';
        return $str;
    }

    // Submit

    public function submit($text, $class = 'btn btn-success', $data = [])
    {
        return '<button class="'.$class.'" '.$this->printAttr($data).'>'.$text.'</button>';
    }
}
