<?php
Class policyController Extends baseController {

    public function index() 
    {
        $this->registry->template->page = 'policy';
        $data = $this->registry->config->getPolicy();
        
        foreach ($data as $value) {
            switch ($value[0]){
                case "policy_copyright":
                    $copy = $value[1];
                    break;
                case "policy_payment":
                    $payment = $value[1];
                    break;
                case "policy_privacy":
                    $privacy = $value[1];
                    break;
                case "policy_return":
                    $return = $value[1];
                    break;
                case "policy_terms":
                    $terms = $value[1];
                    break;
                case "policy_shipping":
                    $shipping = $value[1];
                    break;
            }
        }
        
        $policy = "<h3>TERMS AND CONDITIONS</h3><p>" . $terms . "</p>";
        $policy .= "<h3>COPYRIGHT</h3><p>" . $copy . "</p>";
        $policy .= "<h3>PRIVACY POLICY</h3><p>" . $privacy . "</p>";
        $policy .= "<h3 id='shipping'>SHIPPING INFORMATION</h3><p>" . $shipping . "</p>";
        $policy .= "<h3 id='return'>RETURN AND EXCHANGE</h3><p>" . $return . "</p>";
        $policy .= "<h3>TERMS OF PAYMENT</h3><p>" . $payment . "</p>";
        $policy .= "<script src='js/views/policy.js' type='text/javascript'></script>";
        
        $this->registry->template->info = $policy;
        $this->registry->template->show('information');
    }
}