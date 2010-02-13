<?php
class ControllerClients extends ControllerBase {

	public function actionDefault()
	{

    $this->_Trail->enable();

	}

	public function actionInvoices()
	{
  return;
    include DIR_CONFIG . 'clients.inc.php';

	  $error_template = 'error.ptpl';
	  $invoice_template = 'invoice_detail.ptpl';
	  $client_template = 'invoice_list.ptpl';

	  $client = $this->getRouter()->getArgumentByInt(0);
    $invoice = $this->getRouter()->getArgumentByInt(1);

    if(empty($client))
    {

      $this->_Trail->enable();

    }
    elseif(!array_key_exists($client, $clients))
    {

      $this->_Trail->enable();

      $this->getTemplate()->body->error_msg = 'The client name specified
          ('.$client.') was not found.';
      $this->getTemplate()->body->setTemplateFilenames(array($error_template));

    }
    else
    {

      if(empty($invoice))
      {

        /* show client invoice list */

        $this->_Trail->enable();
        $this->_Trail->mapTrailItem('clients'.WEB_SEP.'invoices'.WEB_SEP.$client, 'Client: '.$clients[$client]['fullname']);

        $this->getTemplate()->body->client = $clients[$client]['fullname'];

        $invoices = array();

        $total_paid = 0;
        $total_notpaid = 0;

        foreach($clients[$client]['invoices'] as $i_number => $i_array)
        {

          $total_cost = 0;
          foreach($i_array['items'] as $item)
          {

            $total_cost += round($item[1]*$item[2]);

          }

          if($i_array['paid'])
          {
            $total_paid += $total_cost;
          }
          else
          {
            $total_notpaid += $total_cost;
          }

          $timestamp = strtotime($i_array['date']);
          $invoices[] = array(
            'link' => WEB_BASE.'clients/invoices/'.$client.'/'.$i_number,
            'invoice' => $i_number,
            'date' => date('M jS, Y', $timestamp),
            'date_due' => date('M jS, Y', $timestamp + (60*60*24*30)),
            'desc' => substr($i_array['desc'], 0, 300).'...
              (<a href="'.WEB_BASE.'clients/invoices/'.$client.'/'.$i_number.'">Read More</a>)',
            'status' => ($i_array['paid'] ? 'PAID' : 'NOT PAID'),
            'cost' => $total_cost
          );

        }

        $this->getTemplate()->body->invoice_paid_info = $total_paid;
        $this->getTemplate()->body->invoice_due_info = $total_notpaid;
        $this->getTemplate()->body->invoiced_info = $total_paid+$total_notpaid;

        $this->getTemplate()->body->invoices = $invoices;

        $this->getTemplate()->body->setTemplateFilenames(array($client_template));

      }
      elseif(array_key_exists($invoice, $clients[$client]['invoices']))
      {

        /* show specific invoice */

        $this->_Trail->enable();
        $this->_Trail->mapTrailItem('clients'.WEB_SEP.'invoices'.WEB_SEP.$client, 'Client: '.$clients[$client]['fullname']);
        $this->_Trail->mapTrailItem($invoice, 'Invoice: '.$invoice);

        $this->getTemplate()->body->client = $clients[$client]['fullname'];
        $this->getTemplate()->body->client_code = $client;

        $i = $clients[$client]['invoices'][$invoice];
        $this->getTemplate()->body->invoice_number = $invoice;
        $timestamp = strtotime($i['date']);
        $this->getTemplate()->body->invoice_date = date('M jS, Y', $timestamp);
        $this->getTemplate()->body->invoice_late = date('M jS, Y', $timestamp + (60*60*24*30));
        $this->getTemplate()->body->invoice_desc = $i['desc'];

        $ii = array();
        $total_time = 0;
        $total_cost = 0;
        foreach($i['items'] as $item)
        {

          $hours = str_pad(floor($item[2]), 2, '0', STR_PAD_LEFT);
          $minutes = str_pad((60*($item[2] - $hours))/1, 2, '0', STR_PAD_LEFT);
          $time = $hours.':'.$minutes;

          if($item[1] > 0)
          {
            $cost = round($item[1]*$item[2], 0);
          }
          else
          {
            $cost = '0';
          }

          $ii[] = array(
            'desc' => $item[0],
            'rate' => $item[1],
            'time' => $time,
            'cost' => $cost
          );

          $total_cost += $cost;
          $total_time += $item[2];

        }

        $this->getTemplate()->body->invoice_items = $ii;
        $this->getTemplate()->body->invoice_total = $total_cost;
        $this->getTemplate()->body->invoice_time =
          str_pad(floor($total_time), 2, '0', STR_PAD_LEFT).':'.
          str_pad(60*($total_time - (floor($total_time)))/1, 2, '0', STR_PAD_LEFT);

        $this->getTemplate()->body->invoice_state = ($i['paid'] ? 'PAID' : 'NOT PAID');


        $this->getTemplate()->body->setTemplateFilenames(array($invoice_template));

      }
      else
      {

        $this->getTemplate()->body->error_msg = 'The invoice number specified
          ('.$invoice.') was not found.';
        $this->getTemplate()->body->setTemplateFilenames(array($error_template));

      }

    }

	}

}
?>
