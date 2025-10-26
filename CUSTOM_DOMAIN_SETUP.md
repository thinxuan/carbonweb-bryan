# Custom Domain Setup - carbon2030.ai

## 🌐 Production Domain Configuration

Your production application uses the custom domain:
- **URL:** https://www.carbon2030.ai/
- **Previously hosted on:** Render
- **Now hosted on:** Google Cloud Run (asia-southeast1)

---

## 📋 Current Setup

- **Service:** carbonwallet-prod
- **Region:** asia-southeast1
- **Project:** carbonwallet-prod-476112
- **Default Cloud Run URL:** https://carbonwallet-prod-5argpeh6mq-as.a.run.app
- **Custom Domain:** www.carbon2030.ai

---

## 🔍 Check Domain Mapping Status

```bash
# List all domain mappings
gcloud run domain-mappings list \
  --region=asia-southeast1 \
  --project=carbonwallet-prod-476112
```

---

## 🔧 Setup Domain Mapping (If Not Already Configured)

### Step 1: Create Domain Mapping in GCP

```bash
# Set the production project
gcloud config set project carbonwallet-prod-476112

# Create domain mapping
gcloud run domain-mappings create \
  --service=carbonwallet-prod \
  --domain=www.carbon2030.ai \
  --region=asia-southeast1
```

### Step 2: Get DNS Configuration

After creating the domain mapping, GCP will provide DNS records to add:

```bash
# Get the DNS records required
gcloud run domain-mappings describe www.carbon2030.ai \
  --region=asia-southeast1 \
  --format="value(status.resourceRecords)"
```

### Step 3: Update DNS Records

You'll need to add these DNS records to your domain provider:

**Example records (actual values will be provided by GCP):**
```
Type: CNAME
Name: www.carbon2030.ai
Value: ghs.googlehosted.com
```

### Step 4: Verify Domain

```bash
# Check domain mapping status
gcloud run domain-mappings describe www.carbon2030.ai \
  --region=asia-southeast1 \
  --format="value(status.conditions)"

# Should show status: "Ready" when DNS is configured correctly
```

---

## 🔄 Update DNS (If Already Configured)

If you need to update DNS records:

### Option 1: Check Current DNS
```bash
# View current domain configuration
gcloud run domain-mappings describe www.carbon2030.ai \
  --region=asia-southeast1
```

### Option 2: Update DNS at Your Domain Provider
1. Go to your domain registrar (where you bought carbon2030.ai)
2. Navigate to DNS settings
3. Update CNAME record for www to point to Cloud Run endpoint

---

## ✅ Verify SSL Certificate

Cloud Run automatically provisions SSL certificates for custom domains. To verify:

```bash
# Check certificate status
gcloud run domain-mappings describe www.carbon2030.ai \
  --region=asia-southeast1 \
  --format="value(status.conditions)"
```

Status should show:
- `type: Ready` - Domain is active
- Certificate is automatically managed by Google

---

## 🌍 Redirect from Render to GCP

If you previously hosted on Render and want to redirect:

### Option 1: Keep Render Running with Redirect
```html
<!-- On Render site -->
<meta http-equiv="refresh" content="0; url=https://www.carbon2030.ai/">
```

### Option 2: Update DNS Only
1. Remove domain from Render
2. Update DNS to point to Cloud Run (as shown above)
3. DNS propagation may take 24-48 hours

---

## 📝 Important Notes

1. **SSL Certificate:** Automatically provisioned by Cloud Run (may take a few minutes to hours after DNS is configured)

2. **DNS Propagation:** Changes can take 24-48 hours to propagate globally

3. **Staging:** Uses default GCP URL (no custom domain)
   - Staging URL: https://carbonwallet-staging-675299815262.us-central1.run.app

4. **Monitoring:** Check domain status regularly
   ```bash
   gcloud run domain-mappings list --region=asia-southeast1
   ```

---

## 🔗 Useful Commands

### Check Domain Status
```bash
gcloud run domain-mappings describe www.carbon2030.ai \
  --region=asia-southeast1 \
  --format="yaml"
```

### View Service URL with Domain
```bash
gcloud run services describe carbonwallet-prod \
  --region=asia-southeast1 \
  --format="value(status.url)"
```

### View All Mappings
```bash
gcloud run domain-mappings list \
  --region=asia-southeast1 \
  --project=carbonwallet-prod-476112
```

---

## 🎯 Quick Reference

**Production URLs:**
- Custom: https://www.carbon2030.ai/
- Default: https://carbonwallet-prod-486326684341.asia-southeast1.run.app

**Staging URLs:**
- Default only: https://carbonwallet-staging-675299815262.us-central1.run.app

---

**Note:** Make sure DNS is properly configured to point to Cloud Run service for the custom domain to work correctly.

