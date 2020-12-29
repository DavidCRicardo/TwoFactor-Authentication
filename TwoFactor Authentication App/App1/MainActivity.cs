using Android.App;
using Android.Content;
using Android.OS;
using Android.Support.V7.App;
using Android.Views;
using Android.Widget;
using System.Timers;

namespace App1
{
    [Activity(Label = "@string/app_name", Theme = "@style/AppTheme", MainLauncher = true)]
    public class MainActivity : AppCompatActivity
    {
       private ISharedPreferences prefs = Application.Context.GetSharedPreferences("PREF_NAME", FileCreationMode.Private);
        
        private TextView txtCountdown;
        private int count = 10;
        Timer timer;
        private bool cDown = false;
        private string _username;
        private int value1;

        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);

            SetContentView(Resource.Layout.MainMenu);

            ISharedPreferencesEditor editor = prefs.Edit();

            value1 = prefs.GetInt("your_key1", 0);
            _username = prefs.GetString("your_key2", null);

            Button btnAddAccount = FindViewById<Button>(Resource.Id.btnToAddAccount);
            txtCountdown = FindViewById<TextView>(Resource.Id.txtCountdown);
            txtCountdown.Visibility = ViewStates.Gone;

            btnAddAccount.Click += delegate
            {
                Intent intent = new Intent(this, typeof(MainActivity1));
                StartActivity(intent);
            };
            
            if (value1 == 1)
            {
                txtCountdown.Visibility = ViewStates.Visible;
                btnAddAccount.Visibility = ViewStates.Gone;

                Button btnUnlock = new Button(this);
                btnUnlock.Tag = 3;
                btnUnlock.Click += delegate { Unlocking(); };
                btnUnlock.Text = "Desbloquear: " + _username.ToString() ;

                Button btnRemove = new Button(this);
                btnRemove.Tag = 4;
                btnRemove.Click += delegate { Removing(); };
                btnRemove.Text = " Remover Conta";

                LinearLayout ll = (LinearLayout)FindViewById(Resource.Id.MainMenuLayout);
                Android.App.ActionBar.LayoutParams lp = new Android.App.ActionBar.LayoutParams(ViewGroup.LayoutParams.MatchParent, ViewGroup.LayoutParams.WrapContent);
                ll.AddView(btnUnlock, lp);
                ll.AddView(btnRemove, lp);
            }
        }

        private void Removing()
        {
            ISharedPreferencesEditor editor = prefs.Edit();
            editor.PutInt("your_key1", 0);
            editor.PutString("your_key2", " ");
            editor.Apply();

            Intent intent = new Intent(this, typeof(MainActivity3));
            StartActivity(intent);
        }

        private void Unlocking()
        {
            if (cDown == false)
            {
                cDown = true;
                toBoolTrue(_username);
                timer_Timing();
            }
        }

        private void timer_Timing()
        {
                timer = new Timer();
                timer.Interval = 1000; //1 second
                timer.Elapsed += Timer_Elapsed;
                timer.Start();

                Toast.MakeText(this, "Começando...", ToastLength.Short).Show();
        }

        private void Timer_Elapsed(object sender, ElapsedEventArgs e)
        {
            if (cDown)
            {
                if (count > 0)
                {
                    count--; //increase count variable
                    RunOnUiThread(() =>
                    {
                        txtCountdown.Text = "Contagem: " + count; //Update count value
                    });
                }
                else
                {
                    RunOnUiThread(() =>
                    {
                        count = 10; // Reset count variable
                        Toast.MakeText(this, "Tempo expirado", ToastLength.Short).Show();
                        txtCountdown.Text = "Contagem: " + count;

                        timer.Stop();
                        toResetBool(_username);
                        cDown = false;
                    });
                }
            }
        }

        private void toBoolTrue(string param)//S2 = true
        {
            Web.GetPost("https://www.davidricardo.x10host.com/turningON.php", "UserName", param);
        }

        private void toResetBool(string param)//S2 = false
        {
            Web.GetPost("https://www.davidricardo.x10host.com/turningOFF.php", "UserName", param);
        }
    }
}