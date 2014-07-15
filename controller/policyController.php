<?php
Class policyController Extends baseController {

    public function index() 
    {
        $this->registry->template->page = 'policy';
        $data = $this->registry->config->getPolicy();
        
        foreach ($data as $value) {
            switch ($value[0]){
                case "policy_consent":
                    $consent = $value[1];
                    break;
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
        
        $policy = "<h3>• Terms and Conditions</h3><p>" . $terms . "</p>";
        $policy .= "<h3>• Copyright</h3><p>" . $copy . "</p>";
        $policy .= "<h3>• Privacy Policy</h3><p>" . $privacy . "</p>";
        $policy .= "<h3>• Consent To Collection, Use & Disclosure of Your Personal Information</h3><p>" . $consent . "</p>";
        $policy .= "<h3>• Shipping Information</h3><p>" . $shipping . "</p>";
        $policy .= "<h3>• Return and Exchange</h3><p>" . $return . "</p>";
        $policy .= "<h3>• Terms of Payment</h3><p>" . $payment . "</p>";
        
        $this->registry->template->info = $policy;
        $this->registry->template->show('information');
    }
}