using System;
using Android.App;
using Android.Content;
using Android.OS;
using Android.Widget;

namespace App1
{
    [Activity(Label = "Activity2")]
    public class MainActivity2 : Activity
    {
        private ISharedPreferences prefs = Application.Context.GetSharedPreferences("PREF_NAME", FileCreationMode.Private);
        private EditText txtCodigo;

        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);

            SetContentView(Resource.Layout.Page2);

            Button _btnNext = FindViewById<Button>(Resource.Id.btnNext);
            Button _btnBack = FindViewById<Button>(Resource.Id.btnBack);
            txtCodigo = FindViewById<EditText>(Resource.Id.editTextCodigo);

            _btnNext.Click += delegate {
                string Data = Web.GetPost("https://www.davidricardo.x10host.com/checkAcc2.php", "Code", txtCodigo.Text);
                Console.WriteLine(Data);

                AlertDialog.Builder dialog = new AlertDialog.Builder(this);
                AlertDialog alert = dialog.Create();

                if (Data == "Something went wrong")
                {
                    alert.SetTitle("Info");
                    alert.SetMessage(Data);
                    alert.SetButton("OK", (c, ev) => {
                    });
                    alert.Show();
                }
                if (Data == "Ativado com Sucesso")
                {
                    alert.SetTitle("Info");
                    alert.SetMessage(Data);
                    alert.SetButton("OK", (c, ev) => {
                    });
                    alert.Show();

                    ISharedPreferencesEditor editor = prefs.Edit();
                    editor.PutInt("your_key1", 1);
                    editor.Apply();

                    Intent intent = new Intent(this, typeof(MainActivity));
                    StartActivity(intent);
                }
            };

            _btnBack.Click += delegate {
                Intent intent = new Intent(this, typeof(MainActivity1));
                StartActivity(intent);
            };
        }
    }
}