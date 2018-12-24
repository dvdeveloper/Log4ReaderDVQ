using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Xml.Linq;

namespace LogReader
{
    public class CreateLog
    {
        public int ID { get; set; }
        public int parent { get; set; }
        private DateTime date { get; set; }
        public String action { get; set; }
        public String title { get; set; }
        public String type { get; set; }
        public String Message { get; set; }
        public String Parameters { get; set; }
        public String Users { get; set; }
        public String IP { get; set; }
        public String Origen { get; set; }

        public int save(string path, string format = "dd-mm-yyyy", string prefix = "")
        {


            date = DateTime.Now;
            int id = 1;

            if (type == "" || type == null)
            {
                type = "info";
            }

            if (title == "" || title == null)
            {
                type = "Unknown";
            }

            if (prefix != "")
            {
                prefix += "_";
            }

            if (format == null)
            {
                format = "dd-mm-yyyy";
            }

            try
            {
                XDocument doc = new XDocument(new XElement("root",
                                                  new XElement("logs",
                                                      new XElement("id", id),
                                                      new XElement("parent", parent),
                                                      new XElement("datetime", date.ToString()),
                                                      new XElement("action", action),
                                                      new XElement("title", title),
                                                      new XElement("type", type),
                                                      new XElement("message", Message),
                                                      new XElement("parameters", Parameters),
                                                      new XElement("users", Users),
                                                      new XElement("ip", IP),
                                                      new XElement("origen", Origen)
                                                      )));

                
                string name = prefix + ""  + DateTime.Now.ToString(format);
                string filename = path + "\\" + name + ".dvq";

                if (!File.Exists(filename))
                {
                    doc.Save(filename);
                }
                else
                {
                    XDocument add = XDocument.Load(filename);
                    id = add.Descendants("logs").Count() + 1;

                    XElement root = new XElement("logs");
                    root.Add(new XElement("id", id));
                    root.Add(new XElement("parent", parent));
                    root.Add(new XElement("datetime", date.ToString()));
                    root.Add(new XElement("action", action));
                    root.Add(new XElement("title", title));
                    root.Add(new XElement("type", type));
                    root.Add(new XElement("message", Message));
                    root.Add(new XElement("parameters", Parameters));
                    root.Add(new XElement("users", Users));
                    root.Add(new XElement("ip", IP));
                    root.Add(new XElement("origen", Origen));
                    add.Element("root").Add(root);
                    add.Save(filename);
                }
            }
            catch (Exception ex)
            {
                return 0;
            }

            return id;
        }
    }
}
