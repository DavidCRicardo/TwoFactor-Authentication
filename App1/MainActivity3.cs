using Android.App;
using Android.Content;
using Android.OS;

namespace App1
{
    [Activity(Label = "Activity3")]
    public class MainActivity3 : Activity
    {
        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);

            SetContentView(Resource.Layout.Page3);

            Intent intent = new Intent(this, typeof(MainActivity));
            StartActivity(intent);
        }
    }
}