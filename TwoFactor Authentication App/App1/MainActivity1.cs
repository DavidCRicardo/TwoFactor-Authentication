using Android.App;
using Android.Content;
using Android.OS;
using Android.Widget;

namespace App1
{
    [Activity(Label = "Activity1")]
    public class MainActivity1 : Activity
    {
        private ISharedPreferences prefs = Application.Context.GetSharedPreferences("PREF_NAME", FileCreationMode.Private);
        private EditText txtNomeConta;
        private EditText txtPassword;

        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);
      
            SetContentView(Resource.Layout.Page1);

            Button btnGoBack = FindViewById<Button>(Resource.Id.btnBacktoMenu);
            Button btnAdd = FindViewById<Button>(Resource.Id.btnAddingAcc);
            txtNomeConta = FindViewById<EditText>(Resource.Id.editTextNomedaConta);
            txtPassword = FindViewById<EditText>(Resource.Id.editTextPassword);

            btnGoBack.Click += delegate {
                Intent intent = new Intent(this, typeof(MainActivity));
                StartActivity(intent);
            };

            btnAdd.Click += delegate {
                ISharedPreferencesEditor editor = prefs.Edit();
                editor.PutString("your_key2", txtNomeConta.Text);
                editor.Apply();

                Web.GetPost("https://www.davidricardo.x10host.com/checkAcc.php", "UserName", txtNomeConta.Text, "Passe", txtPassword.Text);

                Intent intent = new Intent(this, typeof(MainActivity2));
                StartActivity(intent);            
            };
        }
    }
}