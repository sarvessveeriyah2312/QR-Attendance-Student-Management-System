<?php 
  include('includes/dbconnection.php');
  require ("fpdf185/fpdf.php");
  

  //customer and invoice details
  $info=[
    "customer"=>"",
    "address"=>",",
    "city"=>"",
    "invoice_no"=>"",
    "invoice_date"=>"",
    "total_amt"=>"",
    "words"=>"",
  ];
  
  //Select Invoice Details From Database
  $sql="select * from tblpayments where id='{$_GET["id"]}'";
  $query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{       

	  $info=[
		"customer"=>$row->StudentName,
		"studentid"=>$row->StuID,
		"Status"=>$row->Status,
		"Transaction ID"=>$row->Transaction_ID,
		"Transaction Date"=>$row->date_created,
		"Amount"=>$row->Amount,
		// "words"=> $obj->get_words(),
	  ];
}
}
  
  //invoice Products
  $products_info=[];
  

  $sql="select * from tblpayments where id='{$_GET["id"]}'";
  $query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row2)
{       

	  $info=[
		"feesname"=>$row2->FeesName,
    "Amount"=>$row2->Amount,
		// "words"=> $obj->get_words(),
	  ];
}
}
  
  class PDF extends FPDF
  {
    function Header(){
      
      //Display Company Info
      $this->SetFont('Arial','B',14);
      $this->Cell(50,10,"SMS",0,1);
      $this->SetFont('Arial','',14);
      $this->Cell(50,7,"Student Monitoring System",0,1);
      
      //Display INVOICE text
      $this->SetY(15);
      $this->SetX(-70);
      $this->SetFont('Arial','B',18);
      $this->Cell(50,10,"PAYMENT INVOICE",0,1);
      
      //Display Horizontal line
      $this->Line(0,48,210,48);
    }
    
    function body($row){
      
      //Billing Details
      $this->SetY(55);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(50,10,"Bill To: ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,"Student Name: ".$row->StudentName,0,1);
      $this->Cell(50,7,"Student ID: ".$row->StuID,0,1);
      $this->Cell(50,7,"Payment Status: ".$row->Status,0,1);
      
      //Display Invoice no
      $this->SetY(55);
      $this->SetX(-70);
      $this->Cell(50,7,"Invoice No : ".$row->Transaction_ID);
      
      //Display Invoice date
      $this->SetY(63);
      $this->SetX(-70);
      $this->Cell(50,7,"Invoice Date : ".$row->date_created);
      
      //Display Table headings
      $this->SetY(95);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(80,9,"DESCRIPTION",1,0);
      $this->Cell(40,9,"PRICE",1,0,"C");
      $this->Cell(40,9,"TOTAL",1,1,"C");
      $this->SetFont('Arial','',12);
      
      //Display table product rows
     
        $this->Cell(80,9,$row->FeesName,"LR",0);
        $this->Cell(40,9,$row->Amount,"R",0,"R");
        $this->Cell(40,9,$row->Amount,"R",1,"R");
      
      //Display table empty rows
      
      //Display table total row
      $this->SetFont('Arial','B',12);
      $this->Cell(120,9,"STATUS",1,0,"R");
      $this->Cell(40,9,$row->Status,1,1,"R");
      
      //Display amount in words
      $this->SetY(225);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,9,"Payment Aggrement",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(0,9,"I have read, understand and agree with this SMS Payment and Disclosure Statement",0,1);
      
    }
    function Footer(){
      
      //set footer position
      $this->SetY(-50);
      $this->SetFont('Arial','B',12);
      $this->Ln(15);
      $this->SetFont('Arial','',12);
      $this->Cell(0,10,"Invoice Status: Authorized",0,1,"R");
      $this->SetFont('Arial','',10);
      
      //Display Footer Text
      $this->Cell(0,10,"This is a computer generated invoice thus does not require Human Verification",0,1,"C");
      
    }
    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($row,$products_info);
  $pdf->Output();
?>