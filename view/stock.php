<script src="js/views/stock.js" type="text/javascript"></script>
<div class="stock_category">
    <ul>
        <li>EAT</li>
        <li>WALK</li>
        <li>PLAY</li>
        <li>WEAR</li>
        <li>SLEEP</li>
    </ul>
</div>
<div class="stock_main">
    <table>
        <tr>
            <td></td>
            <td>ITEM</td>
            <td>QTY</td>
        </tr>
        <?php
            foreach ($stock as $product) {
                $html = '<tr>';
                $html .= '<td>'.$product['item_no'].'</td>';
                $html .= '<td>'.strtoupper($product['name']).' ('.$product['size'].')</td>';
                $html .= '<td>';
                if (is_numeric($product['stock'])){
                    $html .= '<input class="stock" type="number" min="0" max="99" '
                            . 'item="'.$product['item_no'].'" size="'.$product['size'].'" '
                            . 'base="'.$product['stock'].'" value="'.$product['stock'].'">';
                }else{
                    
                }
                $html .= '</td>';
                $html .= '</tr>';
                
                echo $html;
            }
        ?>
    </table>
</div>
<div class="stock_detail">there are <a>0</a> items changed, <span>click here to save</span></div>
<div class="stock_save">confirm</div>
<input id="token" type="hidden" value="<?php echo $token; ?>" />
<input id="category" type="hidden" value="<?php echo $category; ?>" />