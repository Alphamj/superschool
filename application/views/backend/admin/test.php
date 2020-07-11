<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<h1>This is a Heading</h1>
<p>This is a paragraph.</p>

</body>
</html>
<?php 
    $this->load->library('pdf');
    $this->pdf->load_view('backend/admin/test', $page_data);
    $this->pdf->render();
    $this->pdf->stream("Report.pdf");
