<?php

namespace App\Helpers;

class BSForm
{
    public static function show($method, $action, $data, $submit = [])
    {
        echo '<form method="'.$method.'"';
        if (!empty($action) || strlen($action) > 0) {
            echo ' action="'.$action.'"';
        }
        echo '>';
        foreach ($data as $arr) {
            $fn = $arr[0];
            unset($arr[0]);
            self::$fn($arr);
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

    public static function open($method, $action = '', $data = []): string
    {
        $str = '<form action="'.$action.'" method="'.($method=='PUT'?'POST':$method).'" '.self::printAttr($data).'>';
        $str .= '<input type="hidden" name="_token" value="'.csrf_token().'">';
        if ($method == 'PUT') {
            $str .= '<input type="hidden" name="_method" value="PUT">';
        }
        return $str;
    }

    public static function close($submit, $text = 'Submit', $class = 'btn btn-success', $data = []): string
    {
        if (!$submit) {
            return '</form>';
        }

        return self::submit($text, $class, $data).'</form>';
    }

    public static function printAttr($data)
    {
        $str = '';
        foreach ($data as $k => $v) {
            $str .= $k.'="'.$v.'" ';
        }
        return $str;
    }

    public static function multiInput($datas)
    {
        $str = '';
        foreach ($datas as $data) {
            $str .= self::input(
                $data[0],
                $data[1],
                isset($data[2]) ? $data[2] : '',
                isset($data[3]) ? $data[3] : '',
                isset($data[4]) ? $data[4] : []
            );
        }
        return $str;
    }

    public static function multi($datas)
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
                    $str .= self::$func($data[1], $data[2]);
                    break;

                case 4:
                    $str .= self::$func($data[1], $data[2], $data[3]);
                    break;

                case 5:
                    $str .= self::$func($data[1], $data[2], $data[3], $data[4]);
                    break;

                default:
                    $str .= self::$func($data[1], $data[2], $data[3], $data[4], $data[5]);
                    break;
            }
        }

        return $str;
    }

    public static function multiText($datas)
    {
        $str = '';
        foreach ($datas as $data) {
            $str .= self::input(
                'text',
                $data[0],
                isset($data[1]) ? $data[1] : '',
                isset($data[2]) ? $data[2] : '',
                isset($data[3]) ? $data[3] : []
            );
        }
        return $str;
    }

    public static function input($type, $name, $label = '', $value = '', $data = []): string
    {
        $str = '
        <div class="mb-3">';

        if (!empty($label)) {
            $str .= '<label for="'.$type.'" class="form-label">'.$label.':</label>';
        }

        $str .= '<input type="'.$type.'" class="form-control" name="'.$name.'" value="'.old($name, $value).'" '.self::printAttr($data).'>';
        if ($type == "file") {
            $str .= '<img src="'.$value.'"/>';
        }
        $str .= '</div>';
        return $str;
    }

    public static function select($name, $options, $label = '', $value = '', $data = []): string
    {
        $str = '
        <div class="mb-3">';

        if (!empty($label)) {
            $str .= '<label for="select" class="form-label">'.$label.':</label>';
        }

        $str .= '<select class="form-control" name="'.$name.'" '.self::printAttr($data).'>';
        foreach ($options as $k => $v) {
            $str .= '<option value="'.$k.'"'.($k == old($name, $value) ? ' selected' : '').'>'.$v.'</option>';
        }
        $str .= '
            </select>
        </div>';
        return $str;
    }

    public static function selectM($name, $options, $label = '', $value = [], $data = [])
    {
        $str = '
        <div class="mb-3">';

        if (!empty($label)) {
            $str .= '<label class="form-label" for="select">'.$label.':</label>';
        }

        $str   .= '<select class="form-control" multiple="true" name="'.$name.'[]" '.self::printAttr($data).'>';
        $value = old($name, $value);
        foreach ($options as $k => $v) {
            $str .= '<option value="'.$k.'"'.(in_array($k, $value) ? ' selected' : '').'>'.$v.'</option>';
        }
        $str .= '
            </select>
        </div>';
        return $str;
    }

    public static function textarea($name, $label = '', $value = '', $data = [])
    {
        $str = '
        <div class="mb-3">';

        if (!empty($label)) {
            $str .= '<label for="textarea" class="form-label">'.$label.':</label>';
        }

        $str .= '<textarea class="form-control" name="'.$name.'" '.self::printAttr($data).'>'.old($name, $value).'</textarea>
        </div>';
        return $str;
    }

    // Input Types

    public static function hidden($name, $value = ''): string
    {
        return "<input type=\"hidden\" name=\"$name\" value=\"$value\" />";
    }

    public static function text($name, $label = '', $value = '', $data = [])
    {
        return self::input('text', $name, $label, $value, $data);
    }

    public static function password($name, $label = '', $value = '', $data = [])
    {
        return self::input('password', $name, $label, $value, $data);
    }

    public static function email($name, $label = '', $value = '', $data = [])
    {
        return self::input('email', $name, $label, $value, $data);
    }

    public static function number($name, $label = '', $value = '', $data = [])
    {
        return self::input('number', $name, $label, $value, $data);
    }

    public static function date($name, $label = '', $value = '', $data = [])
    {
        return self::input('date', $name, $label, $value, $data);
    }

    public static function datetime_local($name, $label = '', $value = '', $data = [])
    {
        return self::input('datetime-local', $name, $label, $value, $data);
    }

    public static function range($name, $label = '', $value = '', $data = [])
    {
        return self::input('range', $name, $label, $value, $data);
    }

    public static function file($name, $label = '', $value = '', $data = [])
    {
        return self::input('file', $name, $label, $value, $data);
    }

    public static function checkbox($name, $label = '', $value = '', $data = []): string
    {
        $checked = old($name, $value) ? "checked" : "";
        return '
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="'.$name.'" '.$checked.' '.self::printAttr($data).'>
            <label for="checkbox" class="form-check-label">'.$label.'</label>
        </div>';
    }

    // Submit

    public static function submit($text, $class = 'btn btn-success', $data = []): string
    {
        return '<button type="submit" class="'.$class.'" '.self::printAttr($data).'>'.$text.'</button>';
    }
}
