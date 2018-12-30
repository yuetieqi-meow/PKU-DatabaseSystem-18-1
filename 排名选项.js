
function cll(num,id1,id2) {
    if (num== 1) {
        eval(id1+".style.display=\"\";");
        eval(id2+".style.display=\"none\";");
    } else {
        eval(id2+".style.display=\"\";");
        eval(id1+".style.display=\"none\";");
    }
}