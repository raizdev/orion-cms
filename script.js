class FaTools {

    constructor(url, secretToken) {
        const fetch = require('node-fetch');

        fetch(url, { 
            method: "GET",
            headers: {
                'Authorization': 'Bearer ' + secretToken,
            }
        }).then(res => res.json())
        .then((data) => {
            if(data?.data?.cliTable) {
                this.createCliTable(data.data);
            } else if(data.data) {
                console.log(data.data);
            }
        });
    }
    
    createCliTable(data) {
        var emptyArray = [];
    
        var Table = require('cli-table3');
        var table = new Table({
            head: data.tableHead
        });

        for(var key in data.content) {
            if(!data.except.includes(key)) {
                emptyArray.push(data.content[key])
            }
        }
    
        table.push(emptyArray)
        console.log(table.toString());
    }

    grabServiceIds() {
        const fs = require('fs');
        const file = fs.readFileSync(process.argv.slice(1)[2], 'utf-8');
    
        var emptyArray = [];
    
        const regex = /\b([A-Z]{3}[0-9]{5}|[A-Z]{3}[0-9]{10})\b/g;
    
        file.split(/\r?\n/).forEach((line) => {
            let test = line.matchAll(regex);
            for (const match of test) {
                emptyArray.push(match[0])
            }
        });
    
        let output = emptyArray.join(';');
        
        console.log(output);
        console.log('Total: '+ emptyArray.length);
    }

}

const arguments = process.argv.slice(2).join('/');
const url = `https://kpn.fatools.site/api/${String(arguments)}`;
const secretToken = 'h&TuVSg7!yx(Y2Wb';

fatoolsInstance = new FaTools(url, secretToken);

if(url.includes('grabber')) {
    fatoolsInstance.grabServiceIds();
}