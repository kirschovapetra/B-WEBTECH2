//podla funkcie w3.sortHTML(id, sel, sortvalue) z https://www.w3schools.com/lib/w3.js
function sortTableNumeric(id, sel, sortvalue) {
    var a, b, i, ii, y, bytt, v1, v2, cc, j;
    a = w3.getElements(id);
    for (i = 0; i < a.length; i++) {
        for (j = 0; j < 2; j++) {
            cc = 0;
            y = 1;
            while (y == 1) {
                y = 0;
                b = a[i].querySelectorAll(sel);
                for (ii = 0; ii < (b.length - 1); ii++) {
                    bytt = 0;
                    if (sortvalue) {
                        v1 = b[ii].querySelector(sortvalue).innerText;
                        v2 = b[ii + 1].querySelector(sortvalue).innerText;
                    } else {
                        v1 = b[ii].innerText;
                        v2 = b[ii + 1].innerText;
                    }

                    v1 = v1.toLowerCase();
                    v2 = v2.toLowerCase();

                    var v1_num = isNaN(parseInt(v1)) ? v1 : parseInt(v1);
                    var v2_num = isNaN(parseInt(v2)) ? v2 : parseInt(v2);

                    if ((j == 0 && (v1_num > v2_num)) || (j == 1 && (v1_num < v2_num))) {
                        bytt = 1;
                        break;
                    }
                }
                if (bytt == 1) {
                    b[ii].parentNode.insertBefore(b[ii + 1], b[ii]);
                    y = 1;
                    cc++;
                }
            }
            if (cc > 0) {break;}
        }
    }



}
