using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Xml.Linq;

namespace LogReader
{
    public class Example
    {
        public void WriteLog()
        {
			CreateLog log = new CreateLog();
            log.action = "Load";
            log.title = "Example Tittle";
            log.type = "Success";
            log.Message = "Ok";
            log.Parameters = "number=1&date=dd-mm-yyyy";
            log.Users = "DVQ";
            log.IP = "localhost";
            log.Origen = "Windows Form";
            
            log.save("C:\\Users\\username\\Desktop\\log");
        }
    }
}
