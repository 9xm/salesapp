<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 *  ==============================================================================
 *  Author    : Mian Saleem
 *  Email     : saleem@tecdiary.com
 *  For       : Stock Manager Advance
 *  Web       : http://tecdiary.com
 *  ==============================================================================
 */

class Sma
{
    public function __construct()
    {
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }
    public function number2word($number) {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $decimal_part = $decimal;
        $hundred = null;
        $hundreds = null;
        $digits_length = strlen($no);
        $decimal_length = strlen($decimal);
        $i = 0;
        $str = array();
        $str2 = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
    
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
    
        $d = 0;
        while( $d < $decimal_length ) {
            $divider = ($d == 2) ? 10 : 100;
            $decimal_number = floor($decimal % $divider);
            $decimal = floor($decimal / $divider);
            $d += $divider == 10 ? 1 : 2;
            if ($decimal_number) {
                $plurals = (($counter = count($str2)) && $decimal_number > 9) ? 's' : null;
                $hundreds = ($counter == 1 && $str2[0]) ? ' and ' : null;
                @$str2 [] = ($decimal_number < 21) ? $words[$decimal_number].' '. $digits[$decimal_number]. $plural.' '.$hundred:$words[floor($decimal_number / 10) * 10].' '.$words[$decimal_number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str2[] = null;
        }
    
        $Rupees = implode('', array_reverse($str));
        $paise = implode('', array_reverse($str2));
        $paise = ($decimal_part > 0) ? $paise . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;

        /*if (($number < 0) || ($number > 999999999)) {
            throw new Exception("Number is out of range");
        }
        $giga = floor($number / 1000000);
        // Millions (giga)
        $number -= $giga * 1000000;
        $kilo = floor($number / 1000);
        // Thousands (kilo)
        $number -= $kilo * 1000;
        $hecto = floor($number / 100);
        // Hundreds (hecto)
        $number -= $hecto * 100;
        $deca = floor($number / 10);
        // Tens (deca)
        $n = $number % 10;
        // Ones
        $result = "";
        if ($giga) {
            $result .= $this->number2word($giga) .  "Million";
        }
        if ($kilo) {
            $result .= (empty($result) ? "" : " ") .$this->number2word($kilo) . " Thousand";
        }
        if ($hecto) {
            $result .= (empty($result) ? "" : " ") .$this->number2word($hecto) . " Hundred";
        }
        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
        if ($deca || $n) {
            if (!empty($result)) {
                $result .= " and ";
            }
            if ($deca < 2) {
                $result .= $ones[$deca * 10 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n) {
                    $result .= "-" . $ones[$n];
                }
            }
        }
        if (empty($result)) {
            $result = "zero";
        }
        return $result;*/
    }
    public function actionPermissions($action = null, $module = null)
    {
        if ($this->Owner || $this->Admin) {
            if ($this->Admin && stripos($action, 'delete') !== false) {
                return false;
            }
            return true;
        } elseif ($this->Customer || $this->Supplier) {
            return false;
        }
        if (!$module) {
            $module = $this->m;
        }
        if (!$action) {
            $action = $this->v;
        }
        //$gp = $this->site->checkPermissions();
        if ($this->GP[$module . '-' . $action] == 1) {
            return true;
        }
        return false;
    }

    public function analyze_term($term)
    { //2111111250008
        $spos = strpos($term, $this->Settings->barcode_separator);
        if ($spos !== false) {
            $st        = explode($this->Settings->barcode_separator, $term);
            $sr        = trim($st[0]);
            $option_id = trim($st[1]);
        } else {
            $sr        = $term;
            $option_id = false;
        }
        $barcode = $this->parse_scale_barcode($sr);
        if (!is_array($barcode)) {
            return ['term' => $sr, 'option_id' => $option_id];
        }
        return ['term' => $barcode['item_code'], 'option_id' => $option_id, 'quantity' => $barcode['weight'], 'price' => $barcode['price'], 'strict' => $barcode['strict'] ? ($this->site->getProductByCode($barcode['item_code']) ? false : true) : false];
    }

    public function barcode($text = null, $bcs = 'code128', $height = 74, $stext = 1, $get_be = false, $re = false)
    {
        $drawText = ($stext != 1) ? false : true;
        $this->load->library('tec_barcode', '', 'bc');
        return $this->bc->generate($text, $bcs, $height, $drawText, $get_be, $re);
    }

    public function base64url_decode($data)
    {
        return base64_decode(str_replace(['-', '_'], ['+', '/'], $data));
    }

    public function base64url_encode($data, $pad = null)
    {
        $data = str_replace(['+', '/'], ['-', '_'], base64_encode($data));
        if (!$pad) {
            $data = rtrim($data, '=');
        }
        return $data;
    }

    public function checkPermissions($action = null, $js = null, $module = null)
    {
        if (!$this->actionPermissions($action, $module)) {
            $this->session->set_flashdata('error', lang('access_denied'));
            if ($js) {
                die("<script type='text/javascript'>setTimeout(function(){ window.top.location.href = '" . ($_SERVER['HTTP_REFERER'] ?? site_url('welcome')) . "'; }, 10);</script>");
            }
            redirect($_SERVER['HTTP_REFERER'] ?? 'welcome');
        }
    }

    public function clear_tags($str)
    {
        return htmlentities(
            strip_tags(
                $str,
                '<span><div><a><br><p><b><i><u><img><blockquote><small><ul><ol><li><hr><big><pre><code><strong><em><table><tr><td><th><tbody><thead><tfoot><h3><h4><h5><h6>'
            ),
            ENT_QUOTES | ENT_XHTML | ENT_HTML5,
            'UTF-8'
        );
    }

    public function convertMoney($amount, $format = true, $symbol = true)
    {
        if ($this->Settings->selected_currency != $this->Settings->default_currency) {
            $amount = $this->formatDecimal(($amount * $this->selected_currency->rate), 4);
        }
        return ($format ? $this->formatMoney($amount, $this->selected_currency->symbol) : $amount);
    }

    public function decode_html($str)
    {
        return stripslashes(html_entity_decode($str, ENT_QUOTES | ENT_XHTML | ENT_HTML5, 'UTF-8'));
    }

    public function fld($ldate)
    {
        if ($ldate) {
            $date     = explode(' ', $ldate);
            $jsd      = $this->dateFormats['js_sdate'];
            $inv_date = $date[0];
            $time     = $date[1];
            if ($jsd == 'dd-mm-yyyy' || $jsd == 'dd/mm/yyyy' || $jsd == 'dd.mm.yyyy') {
                $date = substr($inv_date, -4) . '-' . substr($inv_date, 3, 2) . '-' . substr($inv_date, 0, 2) . ' ' . $time;
            } elseif ($jsd == 'mm-dd-yyyy' || $jsd == 'mm/dd/yyyy' || $jsd == 'mm.dd.yyyy') {
                $date = substr($inv_date, -4) . '-' . substr($inv_date, 0, 2) . '-' . substr($inv_date, 3, 2) . ' ' . $time;
            } else {
                $date = $inv_date;
            }
            return $date;
        }
        return '0000-00-00 00:00:00';
    }

    public function formatDecimal($number, $decimals = null)
    {
        if (!is_numeric($number)) {
            return null;
        }
        if (!$decimals && $decimals !== 0) {
            $decimals = $this->Settings->decimals;
        }
        return number_format($number, $decimals, '.', '');
    }

    public function formatMoney($number, $symbol = false)
    {
        if ($symbol !== 'none') {
            $symbol = $symbol ? $symbol : $this->Settings->symbol;
        } else {
            $symbol = null;
        }
        if ($this->Settings->sac) {
            return ((($this->Settings->display_symbol == 1 && $symbol) && $this->Settings->display_symbol != 2) ? $symbol : '') .
            $this->formatSAC($this->formatDecimal($number)) .
            ($this->Settings->display_symbol == 2 ? $symbol : '');
        }
        $decimals = $this->Settings->decimals;
        $ts       = $this->Settings->thousands_sep == '0' ? ' ' : $this->Settings->thousands_sep;
        $ds       = $this->Settings->decimals_sep;
        return ((($this->Settings->display_symbol == 1 && $symbol && $number != 0) && $this->Settings->display_symbol != 2) ? $symbol : '') .
        number_format($number, $decimals, $ds, $ts) .
        ($this->Settings->display_symbol == 2 && $number != 0 ? $symbol : '');
    }

    public function formatNumber($number, $decimals = null)
    {
        if (!$decimals) {
            $decimals = $this->Settings->decimals;
        }
        if ($this->Settings->sac) {
            return $this->formatSAC($this->formatDecimal($number, $decimals));
        }
        $ts = $this->Settings->thousands_sep == '0' ? ' ' : $this->Settings->thousands_sep;
        $ds = $this->Settings->decimals_sep;
        return number_format($number, $decimals, $ds, $ts);
    }

    public function formatQuantity($number, $decimals = null)
    {
        if (!$decimals) {
            $decimals = $this->Settings->qty_decimals;
        }
        if ($this->Settings->sac) {
            return $this->formatSAC($this->formatDecimal($number, $decimals));
        }
        $ts = $this->Settings->thousands_sep == '0' ? ' ' : $this->Settings->thousands_sep;
        $ds = $this->Settings->decimals_sep;
        return number_format($number, $decimals, $ds, $ts);
    }

    public function formatQuantityDecimal($number, $decimals = null)
    {
        if (!$decimals) {
            $decimals = $this->Settings->qty_decimals;
        }
        return number_format($number, $decimals, '.', '');
    }

    public function formatSAC($num)
    {
        $pos = strpos((string) $num, '.');
        if ($pos === false) {
            $decimalpart = '00';
        } else {
            $decimalpart = substr($num, $pos + 1, 2);
            $num         = substr($num, 0, $pos);
        }

        if (strlen($num) > 3 & strlen($num) <= 12) {
            $last3digits         = substr($num, -3);
            $numexceptlastdigits = substr($num, 0, -3);
            $formatted           = $this->makecomma($numexceptlastdigits);
            $stringtoreturn      = $formatted . ',' . $last3digits . '.' . $decimalpart;
        } elseif (strlen($num) <= 3) {
            $stringtoreturn = $num . '.' . $decimalpart;
        } elseif (strlen($num) > 12) {
            $stringtoreturn = number_format($num, 2);
        }

        if (substr($stringtoreturn, 0, 2) == '-,') {
            $stringtoreturn = '-' . substr($stringtoreturn, 2);
        }

        return $stringtoreturn;
    }

    public function fsd($inv_date)
    {
        if ($inv_date) {
            $jsd = $this->dateFormats['js_sdate'];
            if ($jsd == 'dd-mm-yyyy' || $jsd == 'dd/mm/yyyy' || $jsd == 'dd.mm.yyyy') {
                $date = substr($inv_date, -4) . '-' . substr($inv_date, 3, 2) . '-' . substr($inv_date, 0, 2);
            } elseif ($jsd == 'mm-dd-yyyy' || $jsd == 'mm/dd/yyyy' || $jsd == 'mm.dd.yyyy') {
                $date = substr($inv_date, -4) . '-' . substr($inv_date, 0, 2) . '-' . substr($inv_date, 3, 2);
            } else {
                $date = $inv_date;
            }
            return $date;
        }
        return '0000-00-00';
    }

    public function generate_pdf($content, $name = 'download.pdf', $output_type = null, $footer = null, $margin_bottom = null, $header = null, $margin_top = null, $orientation = 'P')
    {
        if ($this->Settings->pdf_lib == 'dompdf') {
            $this->load->library('tec_dompdf', '', 'pdf');
        } else {
            $this->load->library('tec_mpdf', '', 'pdf');
        }

        return $this->pdf->generate($content, $name, $output_type, $footer, $margin_bottom, $header, $margin_top, $orientation);
    }

    public function getCardBalance($number)
    {
        if ($card = $this->site->getGiftCardByNO($number)) {
            return $card->balance;
        }
        return 0;
    }

    public function hrld($ldate)
    {
        if ($ldate) {
            return date($this->dateFormats['php_ldate'], strtotime($ldate));
        }
        return '0000-00-00 00:00:00';
    }

    public function hrsd($sdate)
    {
        if ($sdate) {
            return date($this->dateFormats['php_sdate'], strtotime($sdate));
        }
        return '0000-00-00';
    }

    public function in_group($check_group, $id = false)
    {
        if (!$this->logged_in()) {
            return false;
        }
        $id || $id = $this->session->userdata('user_id');
        $group     = $this->site->getUserGroup($id);
        if ($group->name === $check_group) {
            return true;
        }
        return false;
    }

    public function isPromo($product)
    {
        if (is_array($product)) {
            $product = json_decode(json_encode($product), false);
        }
        $today = date('Y-m-d');
        return $product->promotion && $product->start_date <= $today && $product->end_date >= $today && $product->promo_price;
    }

    public function log_payment($type, $msg, $val = null)
    {
        $this->load->library('logs');
        return (bool) $this->logs->write($type, $msg, $val);
    }

    public function logged_in()
    {
        return (bool) $this->session->userdata('identity');
    }

    public function makecomma($input)
    {
        if (strlen($input) <= 2) {
            return $input;
        }
        $length          = substr($input, 0, strlen($input) - 2);
        $formatted_input = $this->makecomma($length) . ',' . substr($input, -2);
        return $formatted_input;
    }

    public function md($page = false)
    {
        die("<script type='text/javascript'>setTimeout(function(){ window.top.location.href = '" . ($page ? site_url($page) : ($_SERVER['HTTP_REFERER'] ?? 'welcome')) . "'; }, 10);</script>");
    }

    public function paid_opts($paid_by = null, $purchase = false, $empty_opt = false)
    {
        $opts = '';
        if ($empty_opt) {
            $opts .= '<option value="">' . lang('select') . '</option>';
        }
        $opts .= '
        <option value="cash"' . ($paid_by && $paid_by == 'cash' ? ' selected="selected"' : '') . '>' . lang('cash') . '</option>
        <option value="gift_card"' . ($paid_by && $paid_by == 'gift_card' ? ' selected="selected"' : '') . '>' . lang('gift_card') . '</option>
        <option value="CC"' . ($paid_by && $paid_by == 'CC' ? ' selected="selected"' : '') . '>' . lang('CC') . '</option>
        <option value="Cheque"' . ($paid_by && $paid_by == 'Cheque' ? ' selected="selected"' : '') . '>' . lang('cheque') . '</option>
        <option value="other"' . ($paid_by && $paid_by == 'other' ? ' selected="selected"' : '') . '>' . lang('other') . '</option>';
        if (!$purchase) {
            $opts .= '<option value="deposit"' . ($paid_by && $paid_by == 'deposit' ? ' selected="selected"' : '') . '>' . lang('deposit') . '</option>';
        }
        return $opts;
    }

    public function parse_scale_barcode($barcode)
    {
        if (strlen($barcode) == $this->Settings->ws_barcode_chars) {
            $price  = false;
            $weight = false;
            if ($this->Settings->ws_barcode_type == 'price') {
                try {
                    $price = substr($barcode, $this->Settings->price_start - 1, $this->Settings->price_chars);
                    $price = $this->Settings->price_divide_by ? $price / $this->Settings->price_divide_by : $price;
                } catch (\Exception $e) {
                    $price = 0;
                }
            } else {
                try {
                    $weight = substr($barcode, $this->Settings->weight_start - 1, $this->Settings->weight_chars);
                    $weight = $this->Settings->weight_divide_by ? $weight / $this->Settings->weight_divide_by : $weight;
                } catch (\Exception $e) {
                    $weight = 0;
                }
            }
            $item_code = substr($barcode, $this->Settings->item_code_start - 1, $this->Settings->item_code_chars);

            return ['item_code' => $item_code, 'price' => $price, 'weight' => $weight, 'strict' => true];
        }
        return $barcode;
    }

    public function print_arrays()
    {
        $args = func_get_args();
        echo '<pre>';
        foreach ($args as $arg) {
            print_r($arg);
        }
        echo '</pre>';
        die();
    }

    public function qrcode($type = 'text', $text = 'http://tecdiary.com', $size = 2, $level = 'H', $sq = null)
    {
        $file_name = 'assets/uploads/qrcode' . $this->session->userdata('user_id') . ($sq ? $sq : '') . ($this->Settings->barcode_img ? '.png' : '.svg');
        if ($type == 'link') {
            $text = urldecode($text);
        }
        $this->load->library('tec_qrcode', '', 'qr');
        $config = ['data' => $text, 'size' => $size, 'level' => $level, 'savename' => $file_name];
        $this->qr->generate($config);
        $imagedata = file_get_contents($file_name);
        return "<img src='data:image/png;base64," . base64_encode($imagedata) . "' alt='{$text}' class='qrimg' />";
    }

    public function roundMoney($num, $nearest = 0.05)
    {
        return round($num * (1 / $nearest)) * $nearest;
    }

    public function roundNumber($number, $toref = null)
    {
        switch ($toref) {
            case 1:
                $rn = round($number * 20) / 20;
                break;
            case 2:
                $rn = round($number * 2) / 2;
                break;
            case 3:
                $rn = round($number);
                break;
            case 4:
                $rn = ceil($number);
                break;
            default:
                $rn = $number;
        }
        return $rn;
    }

    public function send_email($to, $subject, $message, $from = null, $from_name = null, $attachment = null, $cc = null, $bcc = null)
    {
        // if (DEMO) {
        //     $this->session->set_flashdata('error', 'Emails are disabled in demo.');
        //     return false;
        // }
        list($user, $domain) = explode('@', $to);
        if ($domain != 'tecdiary.com' || DEMO) {
            $result = false;
            $this->load->library('tec_mail');
            try {
                $result = $this->tec_mail->send_mail($to, $subject, $message, $from, $from_name, $attachment, $cc, $bcc);
            } catch (\Exception $e) {
                $this->session->set_flashdata('error', 'Mail Error: ' . $e->getMessage());
                throw new \Exception($e->getMessage());
            }
            return $result;
        }
        return false;
    }

    public function send_json($data)
    {
        header('Content-Type: application/json');
        die(json_encode($data));
        exit;
    }

    public function setCustomerGroupPrice($price, $customer_group)
    {
        if (!isset($customer_group) || empty($customer_group)) {
            return $price;
        }
        return $this->formatDecimal($price + (($price * $customer_group->percent) / 100));
    }

    public function slug($title, $type = null, $r = 1)
    {
        $this->load->helper('text');
        $slug       = url_title(convert_accented_characters($title), '-', true);
        $check_slug = $this->site->checkSlug($slug, $type);
        if (!empty($check_slug)) {
            $slug = $slug . $r;
            $r++;
            $this->slug($slug, $type, $r);
        }
        return $slug;
    }

    public function unset_data($ud)
    {
        if ($this->session->userdata($ud)) {
            $this->session->unset_userdata($ud);
            return true;
        }
        return false;
    }

    public function unzip($source, $destination = './')
    {
        // @chmod($destination, 0777);
        $zip = new ZipArchive;
        if ($zip->open(str_replace('//', '/', $source)) === true) {
            $zip->extractTo($destination);
            $zip->close();
        }
        // @chmod($destination,0755);

        return true;
    }

    public function update_award_points($total, $customer, $user = null, $scope = null)
    {
        if (!empty($this->Settings->each_spent)) {
            $company = $this->site->getCompanyByID($customer);
            if ($total > 0 || $scope) {
                $points = floor(($total / $this->Settings->each_spent) * $this->Settings->ca_point);
            } else {
                $points = ceil(($total / $this->Settings->each_spent) * $this->Settings->ca_point);
            }
            $total_points = $scope ? $company->award_points - $points : $company->award_points + $points;
            $this->db->update('companies', ['award_points' => $total_points], ['id' => $customer]);
        }
        if ($user && !empty($this->Settings->each_sale) && !$this->Customer && !$this->Supplier) {
            $staff = $this->site->getUser($user);
            if ($total > 0 || $scope) {
                $points = floor(($total / $this->Settings->each_sale) * $this->Settings->sa_point);
            } else {
                $points = ceil(($total / $this->Settings->each_sale) * $this->Settings->sa_point);
            }
            $total_points = $scope ? $staff->award_points - $points : $staff->award_points + $points;
            $this->db->update('users', ['award_points' => $total_points], ['id' => $user]);
        }
        return true;
    }

    public function view_rights($check_id, $js = null)
    {
        if (!$this->Owner && !$this->Admin) {
            if ($check_id != $this->session->userdata('user_id') && !$this->session->userdata('view_right')) {
                $this->session->set_flashdata('warning', $this->data['access_denied']);
                if ($js) {
                    die("<script type='text/javascript'>setTimeout(function(){ window.top.location.href = '" . ($_SERVER['HTTP_REFERER'] ?? 'welcome') . "'; }, 10);</script>");
                }
                redirect($_SERVER['HTTP_REFERER'] ?? 'welcome');
            }
        }
        return true;
    }

    public function zip($source = null, $destination = './', $output_name = 'sma', $limit = 5000)
    {
        if (!$destination || trim($destination) == '') {
            $destination = './';
        }

        $this->_rglobRead($source, $input);
        $maxinput  = count($input);
        $splitinto = (($maxinput / $limit) > round($maxinput / $limit, 0)) ? round($maxinput / $limit, 0) + 1 : round($maxinput / $limit, 0);

        for ($i = 0; $i < $splitinto; $i++) {
            $this->_zip(array_slice($input, ($i * $limit), $limit, true), $i, $destination, $output_name);
        }

        unset($input);
    }

    private function _rglobRead($source, &$array = [])
    {
        if (!$source || trim($source) == '') {
            $source = '.';
        }
        foreach ((array) glob($source . '/*/') as $key => $value) {
            $this->_rglobRead(str_replace('//', '/', $value), $array);
        }
        $hidden_files = glob($source . '.*') and $htaccess = preg_grep('/\.htaccess$/', $hidden_files);
        $files        = array_merge(glob($source . '*.*'), $htaccess);
        foreach ($files as $key => $value) {
            $array[] = str_replace('//', '/', $value);
        }
    }

    private function _zip($array, $part, $destination, $output_name = 'sma')
    {
        $zip = new ZipArchive;
        @mkdir($destination, 0777, true);

        if ($zip->open(str_replace('//', '/', "{$destination}/{$output_name}" . ($part ? '_p' . $part : '') . '.zip'), ZipArchive::CREATE)) {
            foreach ((array) $array as $key => $value) {
                $zip->addFile($value, str_replace(['../', './'], null, $value));
            }
            $zip->close();
        }
    }
}
