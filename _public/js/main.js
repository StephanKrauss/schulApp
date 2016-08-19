function printDiv(tabelle) {
    var printContents = document.getElementById(tabelle).innerHTML;

    var w = window.open("","","width=800,height=1000");
    w.document.write(printContents);
    w.print();
    w.close();
}